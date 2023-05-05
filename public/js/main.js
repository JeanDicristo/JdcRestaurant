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

// Récupération des champs de formulaire
const dateField = document.getElementById('reservation_date');
const hourField = document.getElementById('reservation_hour');

function init() {
  // Lorsque la date ou l'heure est modifiée, on vérifie la disponibilité des tables
  dateField.addEventListener('change', checkAvailability);
  hourField.addEventListener('change', checkAvailability);

  // Vérification initiale de la disponibilité des tables
  checkAvailability();
}

function checkAvailability() {
  const date = dateField.value;
  const hour = hourField.value;

  // Envoi de la requête AJAX
  $.post('/verifier_disponibilite_tables', {date: date, hour: hour}, function(response) {
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
  }, 'json');
}

$(document).ready(function() {
  $('#disponibilite_message').html('Veuillez sélectionner une date et une heure pour vérifier la disponibilité.');
  init();
});
