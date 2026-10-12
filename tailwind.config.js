/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.{blade.php,vue,js}',
    './resources/css/**/*.css',
    './app/Filament/**/*.php',
    './vendor/filament/**/*.php',
  ],
  safelist: [
    'text-[11px]',
    'text-[15px]',
    'rounded-[1.75rem]',
    'shadow-[0_30px_80px_-30px_rgba(15,23,42,0.45)]',
    'tracking-[0.32em]',
    'tracking-[0.22em]',
    'tracking-[0.24em]',
    'min-h-40',
    'md:col-span-2',
    'lg:grid-cols-12',
    'lg:col-span-7',
    'lg:col-span-5',
    'bg-emerald-950/30',
    'bg-violet-950/30',
    'bg-white/10',
    'text-emerald-700/80',
    'text-violet-700/80',
    'text-emerald-200/80',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
