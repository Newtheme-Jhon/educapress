<div 
    x-data="
    {
        getCookie: @entangle('getCookie'),
        open: @entangle('showBanner')
    }" 
    x-init="
        function init(){
            //console.log(this.open)
        }
    "
>   

    <div x-show="open" x-cloak class="cookie-consent fixed bottom-0 left-0 w-full z-50 p-4 md:p-6 bg-gray-900 opacity-90 text-white">
        <div class="container mx-auto flex flex-wrap items-center justify-between">
          <div class="flex items-center flex-1 mr-4 mb-4 md:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mr-4 text-yellow-400 hidden md:block" viewBox="0 0 24 24"
              fill="currentColor">
              <path
                d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12q0-2.025.838-3.937T5.163 4.7T8.7 2.5t4.5-.45q.375.05.575.313t.225.712q.05 1.6 1.188 2.738T17.9 7q.525.025.8.3t.3.85q.05 1.05.638 1.725t1.637 1.025q.35.125.538.363t.187.587q.05 2.075-.725 3.925t-2.125 3.238t-3.2 2.187T12 22m0-2q3.05 0 5.413-2.1T20 12.55q-1.25-.55-1.963-1.5t-.962-2.125q-1.925-.275-3.3-1.65t-1.7-3.3q-2-.05-3.512.725T6.037 6.688T4.512 9.325T4 12q0 3.325 2.338 5.663T12 20m-1.5-10q.625 0 1.063-.437T12 8.5t-.437-1.062T10.5 7t-1.062.438T9 8.5t.438 1.063T10.5 10m-2 5q.625 0 1.063-.437T10 13.5t-.437-1.062T8.5 12t-1.062.438T7 13.5t.438 1.063T8.5 15m6.5 1q.425 0 .713-.288T16 15t-.288-.712T15 14t-.712.288T14 15t.288.713T15 16">
              </path>
            </svg>
            <div>
                <h2 class="text-xl font-bold mb-2">Consentir Cookies</h2>
                <p class="text-sm md:text-sm">
                    Este sitio web utiliza cookies propias y de terceros para mejorar tu experiencia de navegación, 
                    analizar el tráfico y personalizar contenidos. 
                    Al hacer clic en 'Aceptar', aceptas nuestra Política de Cookies. 
                    Puedes obtener más información en el siguiente enlace.
    
                    <a href="{{route('pages.cookies')}}" class="text-blue-400 hover:underline">Política de Cookies</a>.
                </p>
            </div>
          </div>
          <div>
            <button wire:click="acceptCookie()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded transition duration-300" aria-label="Accept cookies">
                ACEPTAR
            </button>
          </div>
        </div>
    </div>

</div>
