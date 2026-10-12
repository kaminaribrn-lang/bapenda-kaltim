<?php

namespace App\Policies;

use App\Models\ContentProposal;
use App\Models\User;

class ContentProposalPolicy
{
    /**
     * Determine whether the user can view any content proposals.
     * Semua user dapat melihat list usulan konten
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the content proposal.
     * Semua user dapat melihat detail usulan konten (view-only jika bukan proposer)
     */
    public function view(User $user, ContentProposal $contentProposal): bool
    {
        // Semua authenticated user dapat melihat
        return true;
    }

    /**
     * Determine whether the user can create content proposals.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the content proposal.
     * ONLY proposer (penginput) can update/edit their proposal.
     */
    public function update(User $user, ContentProposal $contentProposal): bool
    {
        // Super admin can always update
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Only proposer can edit, and only in submitted or verified status
        if ((int) $contentProposal->proposer_id === (int) $user->id) {
            return in_array($contentProposal->status, ['submitted', 'verified'], true);
        }

        return false;
    }

    /**
     * Determine whether the user can delete the content proposal.
     */
    public function delete(User $user, ContentProposal $contentProposal): bool
    {
        // Super admin can delete
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Proposer can delete only in submitted status
        if ((int) $contentProposal->proposer_id === (int) $user->id) {
            return $contentProposal->status === 'submitted';
        }

        return false;
    }

    /**
     * Determine whether the user can restore the content proposal.
     */
    public function restore(User $user, ContentProposal $contentProposal): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the content proposal.
     */
    public function forceDelete(User $user, ContentProposal $contentProposal): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can verify the content proposal.
     */
    public function verify(User $user, ContentProposal $contentProposal): bool
    {
        // Only verifier assigned to this proposal can verify
        if ($user->isContentVerifier() && (int) $contentProposal->verifier_id === (int) $user->id) {
            return in_array($contentProposal->status, ['submitted', 'verified'], true);
        }

        // Super admin can verify
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can approve the content proposal.
     */
    public function approve(User $user, ContentProposal $contentProposal): bool
    {
        // Only approver (admin/super admin) can approve
        if ($user->canApproveContentProposal()) {
            return in_array($contentProposal->status, ['verified', 'submitted'], true);
        }

        return $user->isSuperAdmin();
    }
}
