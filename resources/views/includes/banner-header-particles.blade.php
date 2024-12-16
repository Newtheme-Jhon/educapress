<div>
    <div id="particles-js">
      <x-container>
        <div class="grid grid-cols-2 banner gap-6">
          <div class="col-span-2 md:col-span-1 order-2 md:order-1 -mt-10 md:mt-0">
            <h1 class="font-kumb text-4xl text-white fond-semibold px-4">
              Domina el desarrollo web. <br>
              Inscríbete ahora y comienza a construir tu futuro
            </h1>
            <p class="px-4 text-white text-md mt-4">
              Con nuestros cursos, adquirirás las habilidades necesarias para dar vida a tus ideas. Aprenderás de expertos en la industria y desarrollarás proyectos reales.
            </p>
          </div>
          <div class="col-span-2 md:col-span-1 order-1 md:order-2 flex justify-center">
            <figure>
              <img class="object-cover object-center w-[350px] md:w-full" src="{{asset('img/welcome/fvf.webp')}}" alt="banner">
            </figure>
          </div>
        </div>
      </x-container>
      
    </div>

</div>

@push('js')

<script src="{{asset('vendor/particles-js/particles.js')}}"></script>
    
<script>
/* ---- particles.js config ---- */

particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 60,
      "density": {
        "enable": true,
        "value_area": 1000
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 8,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});


/* ---- stats.js config ---- */


</script>

@endpush