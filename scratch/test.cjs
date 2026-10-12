const fs = require('fs');

async function testUrls() {
  const urls = [
    'https://raw.githubusercontent.com/superpikar/indonesia-geojson/master/indonesia.geojson',
    'https://raw.githubusercontent.com/ans-4175/peta-indonesia-geojson/master/kalimantan_timur.geojson',
    'https://raw.githubusercontent.com/yusufsyaifudin/wilayah-indonesia/master/data/list_of_area/kabupaten-kota-kalimantan-timur.json',
    'https://raw.githubusercontent.com/Vizzuality/growasia_calculator/master/public/carto/geojson/idn_gadm28_2.geojson'
  ];

  for (let url of urls) {
    try {
      console.log(`Trying ${url}`);
      let res = await fetch(url);
      if (res.ok) {
        console.log(`SUCCESS: ${url}`);
        // don't download the whole thing if it's huge, just verify it exists
        return url;
      }
    } catch (e) {
      console.log(`Error on ${url}: ${e.message}`);
    }
  }
}
testUrls();
