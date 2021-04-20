jQuery(document).ready(function() {
    /*
    particlesJS.load('particles-js', 'assets/particles.json', function() {
        alert('Yay!');
    });
    */
    fetch("assets/particles.json").then(async response => {
        try {
         const data = await response.json();
         console.log('response data?', data);
       } catch(error) {
         console.log('Error happened here!')
         console.error(error);
       }
      })
});