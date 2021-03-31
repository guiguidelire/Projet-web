const cacheName = "cache-v1";
const assets = [
  
  "./index.php", "./PageInexistante.php", "./gabarit.php",
  "./OffresDeStage/rechercheOffre.php", "./OffresDeStage/postuler.php", "./OffresDeStage/détailOffre.php", "./OffresDeStage/création.php", "./OffresDeStage/POO.php",
  "./Entreprises/détailEntreprise.php", "./Entreprises/gerer.php", "./Entreprises/rechercher.php", "./Entreprises/ModeleDétail.php", "./Entreprises/ModeleGerer.php", "./Entreprises/ModeleRechercher.php", "./Entreprises/vueDétailEntreprise.php", "./Entreprises/vueErreur.php", "./Entreprises/vueGerer.php", "./Entreprises/vueRechercher.php",
  "./Compte/creationCompte.php", "./Compte/deconnexion.php", "./Compte/detailUtilisateur.php", "./Compte/monCompte.php", "./Compte/POO.php", "./Compte/vueErreur.php",
  "./Assets/ConnexionBDD.php", "./Assets/Styles/style.css", "./Assets/Pictures/Calaune.jpg", "./Assets/Pictures/RESEAUalaune.jpg", "./Assets/Pictures/WEBalaune.jpg"

  //la faut mettre les différentes pages

];


// mettre en cache
self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open(cacheName).then(function(cache){
      return cache.addAll(assets);
    })
  );
});
console.log('1');
// fetcher le cache
self.addEventListener("fetch", (e) => {
  console.log(e.request);
  console.log('1');
  e.respondWith(
    caches.match(e.request).then((cache) => {
      return cache || fetch(e.request);
    })
  );
  //if(!navigator.onLine){
    //const headers ={headers:{'Content-Type' : 'text/html;charset=utf-8'}};

   // e.respondWith(new Response("<h1> Pas de connexion internet</h1>", headers));
  //}
 // console.log('fetch sur l url ', e.request.url);
});
console.log('2');

