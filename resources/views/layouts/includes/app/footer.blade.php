

<footer class="bg-white">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://flowbite.com/" class="flex items-center">
                  <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Intereses</h2>
                  <ul class="text-gray-500 font-medium">
                      <li class="mb-2">
                          <a href="{{route('pages.instructor')}}" class="hover:underline">Quiero ser instructor</a>
                      </li>
                      <li class="">
                        <a href="{{route('posts.index')}}" class="hover:underline">Blog</a>
                    </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Siguenos</h2>
                  <ul class="text-gray-500 font-medium">
                      <li class="mb-2">
                          <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Facebook</a>
                      </li>
                      <li class="mb-2">
                          <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Instagram</a>
                      </li>
                      <li>
                        <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Linkedin</a>
                    </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Legal</h2>
                  <ul class="text-gray-500 font-medium">
                    <li class="mb-2">
                        <a href="{{route('pages.privacidad')}}" class="hover:underline">Politica de privacidad</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('pages.cookies')}}" class="hover:underline">Politica de coookies</a>
                    </li>
                    <li>
                        <a href="{{route('pages.condiciones')}}" class="hover:underline">Terminos &amp; Condiciones</a>
                    </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center">© {{date('Y')}} <a href="https://flowbite.com/" class="hover:underline">{{env('APP_NAME')}}™</a>. All Rights Reserved.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0 space-x-2">
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <i class="fab fa-facebook"></i>
                <span class="sr-only">Facebook page</span>
            </a>
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <i class="fab fa-instagram-square"></i>
                <span class="sr-only">Instagram page</span>
            </a>
            <a href="#" class="text-gray-500 hover:text-gray-900">
                <i class="fab fa-linkedin"></i>
                <span class="sr-only">Linkedin page</span>
            </a>
          </div>
      </div>
    </div>
</footer>
