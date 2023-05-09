window.addEventListener('load', () => {
  const linkNav = document.querySelectorAll('.nav-link');
  const titleHeader = document.querySelectorAll('h1');

  if (linkNav.length) {
    const TL = gsap.timeline({ paused: true });

    TL.staggerFrom(linkNav, 1, { top: -50, opacity: 0, ease: "power2.out" }, 0.2)
      .from(titleHeader, 2, { top: -50, opacity: 0, ease: "power2.out" }, 0.2);

    TL.play();
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const dateField = document.getElementById('reservation_date');
  const hourField = document.getElementById('reservation_hour');

  dateField.addEventListener('change', checkAvailability);
  hourField.addEventListener('change', checkAvailability);

  checkAvailability();
});

function verifierDisponibiliteTables(date, heure) {
  // On crée une requête HTTP
  const xhr = new XMLHttpRequest();

  // On spécifie la méthode de la requête HTTP
  xhr.open('POST', '/verifier_disponibilite_tables');

  // On spécifie le format de données attendu pour la réponse
  xhr.responseType = 'json';

  // On définit la fonction à exécuter lorsque la réponse est reçue
  xhr.onload = function() {
    // Si la réponse indique que des tables sont disponibles
    if (xhr.status === 200 && xhr.response.disponible) {
      // On affiche un message pour informer l'utilisateur
      const message = 'Des tables sont disponibles pour le ' + date + ' à ' + heure;
      afficherMessageDisponibilite(message);
    } else {
      // Sinon, on affiche un message d'erreur
      const message = 'Désolé, aucune table n\'est disponible pour le ' + date + ' à ' + heure;
      afficherMessageDisponibilite(message, true);
    }
  };

  // On définit la fonction à exécuter en cas d'erreur de la requête
  xhr.onerror = function() {
    console.error('Une erreur est survenue lors de la requête');
  };

  // On envoie la requête en y incluant les données de la date et de l'heure
  xhr.send(JSON.stringify({ date: date, heure: heure }));
}

// function init() {
//   // Lorsque la date ou l'heure est modifiée, on vérifie la disponibilité des tables
//   dateField.addEventListener('change', checkAvailability);
//   hourField.addEventListener('change', checkAvailability);

//   // Vérification initiale de la disponibilité des tables
//   checkAvailability();
// }

function checkAvailability() {
  const date = dateField.value;
  const hour = hourField.value;


  // Envoi de la requête AJAX
  $.ajax({
    url: '/verifier_disponibilite_tables',
    method: 'POST',
    dataType: 'json',
    data: {date: date, hour: hour},
    success: function(response) {
      // Affichage de la réponse de la requête
      if (response.disponible) {
        $('#disponibilite_message').text('Des tables sont disponibles!');
        $('#disponibilite_message').removeClass('alert-danger');
        $('#disponibilite_message').addClass('alert-success');
      } else {
        $('#disponibilite_message').text('Désolé, aucune table n\'est disponible à cette heure.');
        $('#disponibilite_message').removeClass('alert-success');
        $('#disponibilite_message').addClass('alert-danger');
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  })
  
};
