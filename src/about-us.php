<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="./assets/css/tailwind-ecommerce.css" />

    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#207891" />
    <meta name="msapplication-TileColor" content="#ffc40d" />
    <meta name="theme-color" content="#ffffff" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>About Us</title>
  </head>

  <body x-data="{ desktopMenuOpen: false, mobileMenuOpen: false}">
    <main class="h-screen flex flex-col justify-between">
      <div>
        <!-- Header -->
        <header
          class="mx-auto w-full flex h-16 max-w-[1200px] items-center justify-between px-5"
        >
          <a href="index.php">
            <img
              class="cursor-pointer sm:h-auto sm:w-auto"
              src="./assets/images/company-logo.svg"
              alt="company logo"
            />
          </a>

          <div class="md:hidden">
            <button @click="mobileMenuOpen = ! mobileMenuOpen">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-8 w-8"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                />
              </svg>
            </button>
          </div>

          <form class="hidden h-9 w-2/5 items-center border md:flex">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="mx-3 h-4 w-4"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
              />
            </svg>

            <input
              class="hidden w-11/12 outline-none md:block"
              type="search"
              placeholder="Search"
            />

            <button
              class="ml-auto h-full bg-amber-400 px-4 hover:bg-yellow-300"
            >
              Search
            </button>
          </form>

          <div class="hidden gap-3 md:!flex">
            <a
              href="wishlist.php"
              class="flex cursor-pointer flex-col items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                />
              </svg>

              <p class="text-xs">Wishlist</p>
            </a>

            <a
              href="cart.php"
              class="flex cursor-pointer flex-col items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-6 w-6"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 004.25 22.5h15.5a1.875 1.875 0 001.865-2.071l-1.263-12a1.875 1.875 0 00-1.865-1.679H16.5V6a4.5 4.5 0 10-9 0zM12 3a3 3 0 00-3 3v.75h6V6a3 3 0 00-3-3zm-3 8.25a3 3 0 106 0v-.75a.75.75 0 011.5 0v.75a4.5 4.5 0 11-9 0v-.75a.75.75 0 011.5 0v.75z"
                  clip-rule="evenodd"
                />
              </svg>

              <p class="text-xs">Cart</p>
            </a>

            <a
              href="account-page.php"
              class="relative flex cursor-pointer flex-col items-center justify-center"
            >
              <span class="absolute bottom-[33px] right-1 flex h-2 w-2">
                <span
                  class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"
                ></span>
                <span
                  class="relative inline-flex h-2 w-2 rounded-full bg-red-500"
                ></span>
              </span>

              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                />
              </svg>

              <p class="text-xs">Account</p>
            </a>
          </div>
        </header>
        <!-- /Header -->

        <!-- Burger menu  -->
        <section
          x-show="mobileMenuOpen"
          @click.outside="mobileMenuOpen = false"
          class="absolute left-0 right-0 z-50 h-screen w-full bg-white"
          style="display: none"
        >
          <div class="mx-auto">
            <div class="mx-auto flex w-full justify-center gap-3 py-4">
              <a
                href="wishlist.php"
                class="flex cursor-pointer flex-col items-center justify-center"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-6 w-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                  />
                </svg>

                <p class="text-xs">Wishlist</p>
              </a>

              <a
                href="cart.php"
                class="flex cursor-pointer flex-col items-center justify-center"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-6 w-6"
                >
                  <path
                    fill-rule="evenodd"
                    d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 004.25 22.5h15.5a1.875 1.875 0 001.865-2.071l-1.263-12a1.875 1.875 0 00-1.865-1.679H16.5V6a4.5 4.5 0 10-9 0zM12 3a3 3 0 00-3 3v.75h6V6a3 3 0 00-3-3zm-3 8.25a3 3 0 106 0v-.75a.75.75 0 011.5 0v.75a4.5 4.5 0 11-9 0v-.75a.75.75 0 011.5 0v.75z"
                    clip-rule="evenodd"
                  />
                </svg>

                <p class="text-xs">Cart</p>
              </a>

              <a
                href="account-page.php"
                class="relative flex cursor-pointer flex-col items-center justify-center"
              >
                <span class="absolute bottom-[33px] right-1 flex h-2 w-2">
                  <span
                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"
                  ></span>
                  <span
                    class="relative inline-flex h-2 w-2 rounded-full bg-red-500"
                  ></span>
                </span>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-6 w-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                  />
                </svg>

                <p class="text-xs">Account</p>
              </a>
            </div>

            <form class="my-4 mx-5 flex h-9 items-center border">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="mx-3 h-4 w-4"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                />
              </svg>

              <input
                class="hidden w-11/12 outline-none md:block"
                type="search"
                placeholder="Search"
              />

              <button
                type="submit"
                class="ml-auto h-full bg-amber-400 px-4 hover:bg-yellow-300"
              >
                Search
              </button>
            </form>
            <ul class="text-center font-medium">
              <li class="py-2"><a href="index.php">Home</a></li>
              <li class="py-2"><a href="catalog.php">Catalog</a></li>
              <li class="py-2"><a href="about-us.php">About Us</a></li>
              <li class="py-2"><a href="contact-us.php">Contact Us</a></li>
            </ul>
          </div>
        </section>
        <!-- /Burger menu  -->

        <!-- Nav bar -->
        <!-- hidden on small devices -->

        <nav class="relative bg-violet-900">
          <div
            class="mx-auto hidden h-12 w-full max-w-[1200px] items-center md:flex"
          >
            <button
              @click="desktopMenuOpen = ! desktopMenuOpen"
              class="ml-5 flex h-full w-40 cursor-pointer items-center justify-center bg-amber-400"
            >
              <div class="flex justify-around" href="#">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="mx-1 h-6 w-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                  />
                </svg>

                All categories
              </div>
            </button>

            <div class="mx-7 flex gap-8">
              <a
                class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="index.php"
                >Home</a
              >
              <a
                class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="catalog.php"
                >Catalog</a
              >
              <a
                class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="about-us.php"
                >About Us</a
              >
              <a
                class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="contact-us.php"
                >Contact Us</a
              >
            </div>

            <div class="ml-auto flex gap-4 px-5">
              <a
                class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="login.php"
                >Login</a
              >

              <span class="text-white">&#124;</span>

              <a
                class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="sign-up.php"
                >Sign Up</a
              >
            </div>
          </div>
        </nav>
        <!-- /Nav bar -->

        <!-- Menu  -->
        <section
          x-show="desktopMenuOpen"
          @click.outside="desktopMenuOpen = false"
          class="absolute left-0 right-0 z-10 w-full border-b border-r border-l bg-white"
          style="display: none"
        >
          <div class="mx-auto flex max-w-[1200px] py-10">
            <div class="w-[300px] border-r">
              <ul class="px-5">
                <li
                  class="active:blue-900 flex items-center gap-2 bg-amber-400 py-2 px-3 active:bg-amber-400"
                >
                  <img
                    width="15px"
                    height="15px"
                    src="./assets/images/bed.svg"
                    alt="Bedroom icon"
                  />
                  Bedroom
                  <span class="ml-auto"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-4 w-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                      />
                    </svg>
                  </span>
                </li>

                <li
                  class="active:blue-900 flex items-center gap-2 py-2 px-3 hover:bg-neutral-100 active:bg-amber-400"
                >
                  <img
                    width="15px"
                    height="15px"
                    src="./assets/images/sleep.svg"
                    alt="bedroom icon"
                  />
                  Matrass
                  <span class="ml-auto"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-4 w-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                      />
                    </svg>
                  </span>
                </li>

                <li
                  class="active:blue-900 flex items-center gap-2 py-2 px-3 hover:bg-neutral-100 active:bg-amber-400"
                >
                  <img
                    width="15px"
                    height="15px"
                    src="./assets/images/outdoor.svg"
                    alt="bedroom icon"
                  />
                  Outdoor
                  <span class="ml-auto"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-4 w-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                      />
                    </svg>
                  </span>
                </li>

                <li
                  class="active:blue-900 flex items-center gap-2 py-2 px-3 hover:bg-neutral-100 active:bg-amber-400"
                >
                  <img
                    width="15px"
                    height="15px"
                    src="./assets/images/sofa.svg"
                    alt="bedroom icon"
                  />
                  Sofa
                  <span class="ml-auto"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-4 w-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                      />
                    </svg>
                  </span>
                </li>

                <li
                  class="active:blue-900 flex items-center gap-2 py-2 px-3 hover:bg-neutral-100 active:bg-amber-400"
                >
                  <img
                    width="15px"
                    height="15px"
                    src="./assets/images/kitchen.svg"
                    alt="bedroom icon"
                  />
                  Kitchen
                  <span class="ml-auto"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-4 w-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                      />
                    </svg>
                  </span>
                </li>

                <li
                  class="active:blue-900 flex items-center gap-2 py-2 px-3 hover:bg-neutral-100 active:bg-amber-400"
                >
                  <img
                    width="15px"
                    height="15px"
                    src="./assets/images/food.svg"
                    alt="Food icon"
                  />
                  Living room
                  <span class="ml-auto"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-4 w-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                      />
                    </svg>
                  </span>
                </li>
              </ul>
            </div>

            <div class="flex w-full justify-between">
              <div class="flex gap-6">
                <div class="mx-5">
                  <p class="font-medium text-gray-500">BEDS</p>
                  <ul class="text-sm leading-8">
                    <li><a href="product-overview.php">Italian bed</a></li>
                    <li><a href="product-overview.php">Queen-size bed</a></li>
                    <li>
                      <a href="product-overview.php">Wooden craft bed</a>
                    </li>
                    <li><a href="product-overview.php">King-size bed</a></li>
                  </ul>
                </div>

                <div class="mx-5">
                  <p class="font-medium text-gray-500">LAMPS</p>
                  <ul class="text-sm leading-8">
                    <li>
                      <a href="product-overview.php">Italian Purple Lamp</a>
                    </li>
                    <li><a href="product-overview.php">APEX Lamp</a></li>
                    <li><a href="product-overview.php">PIXAR lamp</a></li>
                    <li>
                      <a href="product-overview.php">Ambient Nightlamp</a>
                    </li>
                  </ul>
                </div>

                <div class="mx-5">
                  <p class="font-medium text-gray-500">BEDSIDE TABLES</p>
                  <ul class="text-sm leading-8">
                    <li><a href="product-overview.php">Purple Table</a></li>
                    <li><a href="product-overview.php">Easy Bedside</a></li>
                    <li><a href="product-overview.php">Soft Table</a></li>
                    <li><a href="product-overview.php">Craft Table</a></li>
                  </ul>
                </div>

                <div class="mx-5">
                  <p class="font-medium text-gray-500">SPECIAL</p>
                  <ul class="text-sm leading-8">
                    <li><a href="product-overview.php">Humidifier</a></li>
                    <li><a href="product-overview.php">Bed Cleaner</a></li>
                    <li><a href="product-overview.php">Vacuum Cleaner</a></li>
                    <li><a href="product-overview.php">Pillow</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- /Menu  -->

        <!-- BG Image  -->

        <div class="relative">
          <img
            class="w-full object-cover brightness-50 filter lg:h-[500px]"
            src="./assets/images/about-us-bg.jpeg"
            alt="Iphone with Macbook image"
          />

          <div
            class="absolute top-1/2 left-1/2 mx-auto flex w-11/12 max-w-[1200px] -translate-x-1/2 -translate-y-1/2 flex-col text-center text-white lg:ml-5"
          >
            <h1 class="text-4xl font-bold sm:text-5xl">About Us</h1>
            <p class="mx-auto pt-3 text-xs lg:w-3/5 lg:pt-5 lg:text-base">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit.
              Consequatur aperiam natus, nulla, obcaecati nesciunt, itaque
              adipisci earum ducimus pariatur eaque labore.
            </p>
          </div>
        </div>

        <!-- /BG IMAGE  -->
      </div>

      <section class="flex-grow">
        <div class="mt-6 flex flex-col gap-3">
          <img
            class="mx-auto w-[200px]"
            src="./assets/images/company-logo.svg"
            alt="Maybell Logo"
          />
          <p class="text-center text-sm">Since 1999</p>
        </div>

        <div
          class="mx-auto my-10 flex max-w-[600px] flex-col items-center justify-center px-5"
        >
          <h2 class="w-full text-left text-xl font-bold">Our Mission:</h2>
          <p class="py-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
            placeat odit, est eum dolorem esse totam iusto necessitatibus
            eligendi illo doloribus vero aperiam atque tempora repudiandae
            molestiae nemo distinctio quisquam!
          </p>
          <div class="grid grid-cols-1 gap-3 lg:grid-cols-3">
            <img
              class="object-cover"
              src="./assets/images/mission-family.jpg"
              alt="Family in living room"
            />
            <img
              class="object-cover"
              src="./assets/images/mission-interior.jpg"
              alt="Interior"
            />
            <img
              class="object-cover"
              src="./assets/images/mission-materials.jpg"
              alt="Materials"
            />
          </div>
          <p class="py-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
            placeat odit, est eum dolorem esse totam iusto necessitatibus
            eligendi illo doloribus vero aperiam atque tempora repudiandae
            molestiae nemo distinctio quisquam!
          </p>

          <h2 class="mt-3 w-full text-left text-xl font-bold">Our Vision:</h2>
          <p class="py-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
            placeat odit, est eum dolorem esse totam iusto necessitatibus
            eligendi illo doloribus vero aperiam atque tempora repudiandae
            molestiae nemo distinctio quisquam!
          </p>

          <h2 class="mt-3 w-full text-left text-xl font-bold">Our Values:</h2>
          <p class="py-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
            placeat odit, est eum dolorem esse totam iusto necessitatibus
            eligendi illo doloribus vero aperiam atque tempora repudiandae
            molestiae nemo distinctio quisquam!
          </p>
          <div class="grid grid-cols-1 gap-3 lg:grid-cols-3">
            <img
              class="object-cover"
              src="./assets/images/mission-family.jpg"
              alt="Family in living room"
            />
            <img
              class="object-cover"
              src="./assets/images/mission-interior.jpg"
              alt="Interior"
            />
            <img
              class="object-cover"
              src="./assets/images/mission-materials.jpg"
              alt="Materials"
            />
          </div>
        </div>
      </section>

      <!-- Desktop Footer  -->

      <footer
        class="mx-auto w-full max-w-[1200px] justify-between pb-10 flex flex-col lg:flex-row"
      >
        <div class="ml-5">
          <img
            class="mt-10 mb-5"
            src="./assets/images/company-logo.svg"
            alt="company logo"
          />
          <p class="pl-0">
            Lorem ipsum dolor sit amet consectetur <br />
            adipisicing elit.
          </p>
          <div class="mt-10 flex gap-3">
            <a href="https://github.com/bbulakh">
              <img
                class="h-5 w-5 cursor-pointer"
                src="./assets/images/github.svg"
                alt="github icon"
              />
            </a>
            <a href="https://t.me/b_bulakh">
              <img
                class="h-5 w-5 cursor-pointer"
                src="./assets/images/telegram.svg"
                alt="telegram icon"
              />
            </a>
            <a href="https://www.linkedin.com/in/bogdan-bulakh-393284190/">
              <img
                class="h-5 w-5 cursor-pointer"
                src="./assets/images/linkedin.svg"
                alt="twitter icon"
              />
            </a>
          </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="mx-5 mt-10">
            <p class="font-medium text-gray-500">FEATURES</p>
            <ul class="text-sm leading-8">
              <li><a href="#">Marketing</a></li>
              <li><a href="#">Commerce</a></li>
              <li><a href="#">Analytics</a></li>
              <li><a href="#">Merchendise</a></li>
            </ul>
          </div>

          <div class="mx-5 mt-10">
            <p class="font-medium text-gray-500">SUPPORT</p>
            <ul class="text-sm leading-8">
              <li><a href="#">Pricing</a></li>
              <li><a href="#">Docs</a></li>
              <li><a href="#">Audition</a></li>
              <li><a href="#">Art Status</a></li>
            </ul>
          </div>

          <div class="mx-5 mt-10">
            <p class="font-medium text-gray-500">DOCUMENTS</p>
            <ul class="text-sm leading-8">
              <li><a href="#">Terms</a></li>
              <li><a href="#">Conditions</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">License</a></li>
            </ul>
          </div>

          <div class="mx-5 mt-10">
            <p class="font-medium text-gray-500">DELIVERY</p>
            <ul class="text-sm leading-8">
              <li><a href="#">List of countries</a></li>
              <li><a href="#">Special information</a></li>
              <li><a href="#">Restrictions</a></li>
              <li><a href="#">Payment</a></li>
            </ul>
          </div>
        </div>
      </footer>
      <!-- /Desktop Footer  -->

      <!-- Payment and copyright  -->

      <section class="h-11 bg-amber-400">
        <div
          class="mx-auto flex max-w-[1200px] items-center justify-between px-4 pt-2"
        >
          <p>&copy; Bogdan Bulakh, 2023</p>
          <div class="flex items-center space-x-3">
            <img
              class="h-8"
              src="https://cdn-icons-png.flaticon.com/512/5968/5968299.png"
              alt="Visa icon"
            />
            <img
              class="h-8"
              src="https://cdn-icons-png.flaticon.com/512/349/349228.png"
              alt="AE icon"
            />
            <img
              class="h-8"
              src="https://cdn-icons-png.flaticon.com/512/5968/5968144.png"
              alt="Apple pay icon"
            />
          </div>
        </div>
      </section>
    </main>
    <!-- /Payment and copyright  -->
    <script type="module" src="./assets/js/script.js"></script>
  </body>
</html>
