<?php
session_start();
include "db.php";
$check=new DataBase();
$connect = $check->connect;

$total_price=isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;
$email=isset($_SESSION['email'])? $_SESSION['email'] : NULL;

$sql_cart="SELECT *FROM cart WHERE email='$email'";
$result_cart=mysqli_query($connect,$sql_cart);
$nums_row=mysqli_num_rows($result_cart);

// // fetch user's address 

// $sql_address="SELECT *FROM account WHERE email='$email'";
// $result_address=mysqli_query($connect,$sql_address);
// $rows_address=mysqli_fetch_assoc($result_address);

// // end of fetch process
?>
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
    <title>Checkout</title>
  </head>

  <body x-data="{ desktopMenuOpen: false, mobileMenuOpen: false}">
    <main class="h-screen flex flex-col justify-between">
      <div>
        <!-- Header -->
        <header
          class="mx-auto flex h-16 max-w-[1200px] items-center justify-between px-5"
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

        <!-- breadcrumbs  -->

        <nav class="mx-auto w-full mt-4 max-w-[1200px] px-5">
          <ul class="flex items-center">
            <li class="cursor-pointer">
              <a href="index.php">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5"
                >
                  <path
                    d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z"
                  />
                  <path
                    d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"
                  />
                </svg>
              </a>
            </li>
            <li>
              <span class="mx-2 text-gray-500">&gt;</span>
            </li>

            <li class="text-gray-500">Checkout</li>
          </ul>
        </nav>
        <!-- /breadcrumbs  -->
      </div>

      <div class="flex-grow">
        <section
          class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10"
        >
          <h2 class="mx-auto px-5 text-2xl font-bold md:hidden">
            Checkout Review
          </h2>
          <!-- form  -->
          <section
            class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10"
          >
            <table class="hidden lg:table">
              <thead class="h-16 bg-neutral-100">
                <tr>
                  <th>ADDRESS</th>
                  <th>DELIVERY METHOD</th>
                  <th>PAYMENT METHOD</th>
                  <th class="bg-neutral-600 text-white">ORDER REVIEW</th>
                </tr>
              </thead>
            </table>

            <!-- Mobile product table  -->
            <section
              class="container mx-auto my-3 flex w-full flex-col gap-3 md:hidden"
            >
              <!-- 1 -->

              <div class="flex w-full border px-4 py-4">
                <img
                  class="self-start object-contain"
                  width="90px"
                  src="./assets/images/bedroom.png"
                  alt="bedroom image"
                />
                <div class="ml-3 flex w-full flex-col justify-center">
                  <div class="flex items-center justify-between">
                    <p class="text-xl font-bold">ITALIAN BED</p>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      class="h-5 w-5"
                    >
                      <path
                        d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z"
                      />
                    </svg>
                  </div>
                  <p class="text-sm text-gray-400">Size: XL</p>
                  <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                  <div class="mt-2 flex w-full items-center justify-between">
                    <div class="flex items-center justify-center">
                      <div
                        class="flex cursor-text items-center justify-center active:ring-gray-500"
                      >
                        Quantity: 1
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- 2 -->

              <div class="flex w-full border px-4 py-4">
                <img
                  class="self-start object-contain"
                  width="90px"
                  src="./assets/images/product-chair.png"
                  alt="Chair image"
                />
                <div class="ml-3 flex w-full flex-col justify-center">
                  <div class="flex items-center justify-between">
                    <p class="text-xl font-bold">GUYER CHAIR</p>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      class="h-5 w-5"
                    >
                      <path
                        d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z"
                      />
                    </svg>
                  </div>
                  <p class="text-sm text-gray-400">Size: XL</p>
                  <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                  <div class="mt-2 flex w-full items-center justify-between">
                    <div class="flex items-center justify-center">
                      <div
                        class="flex cursor-text items-center justify-center active:ring-gray-500"
                      >
                        Quantity: 1
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- 3 -->

              <div class="flex w-full border px-4 py-4">
                <img
                  class="self-start object-contain"
                  width="90px"
                  src="./assets/images/outdoors.png"
                  alt="Outdoor chair image"
                />
                <div class="ml-3 flex w-full flex-col justify-center">
                  <div class="flex items-center justify-between">
                    <p class="text-xl font-bold">OUTDOOR CHAIR</p>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      class="h-5 w-5"
                    >
                      <path
                        d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z"
                      />
                    </svg>
                  </div>
                  <p class="text-sm text-gray-400">Size: XL</p>
                  <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                  <div class="mt-2 flex w-full items-center justify-between">
                    <div class="flex items-center justify-center">
                      <div
                        class="flex cursor-text items-center justify-center active:ring-gray-500"
                      >
                        Quantity: 1
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- 4 -->

              <div class="flex w-full border px-4 py-4">
                <img
                  class="self-start object-contain"
                  width="90px"
                  src="./assets/images/matrass.png"
                  alt="Matrass image"
                />
                <div class="ml-3 flex w-full flex-col justify-center">
                  <div class="flex items-center justify-between">
                    <p class="text-xl font-bold">MATRASS COMFORT &plus;</p>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      class="h-5 w-5"
                    >
                      <path
                        d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z"
                      />
                    </svg>
                  </div>
                  <p class="text-sm text-gray-400">Size: XL</p>
                  <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                  <div class="mt-2 flex w-full items-center justify-between">
                    <div class="flex items-center justify-center">
                      <div
                        class="flex cursor-text items-center justify-center active:ring-gray-500"
                      >
                        Quantity: 1
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!-- /Mobile product table  -->

            <!-- Product table  -->

            <table class="mt-3 hidden w-full lg:table">
              <thead class="h-16 bg-neutral-100">
                <tr>
                  <th>ITEM</th>
                  <th>PRICE</th>
                  <th>QUANTITY</th>
                  <th>TOTAL</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for($i=0;$i<$nums_row;$i++):
                  $rows=mysqli_fetch_assoc($result_cart);
                ?>
                <tr class="h-[100px] border-b">
                  <td class="align-middle">
                    <div class="flex">
                      <img
                        class="w-[90px]"
                        src="<?php echo $rows['image']?>"
                        alt="bedroom image"
                      />
                      <div class="ml-3 flex flex-col justify-center">
                        <p class="text-xl font-bold"><?php echo $rows['name']?></p>
                        <p class="text-sm text-gray-400">Size: XL</p>
                      </div>
                    </div>
                  </td>
                  <td class="mx-auto text-center">&#36;<?php echo $rows['price']?></td>
                  <td class="text-center align-middle">1</td>
                  <td class="mx-auto text-center">&#36;<?php echo $rows['total_price']?></td>
                </tr>
                <?php endfor; ?>
              </tbody>
            </table>
            <!-- /Product table  -->

            <div class="flex w-full items-center justify-between">
              <a
                href="catalog.php"
                class="hidden text-sm text-violet-900 lg:block"
                >&larr; Back to the shop</a
              >

              <div class="mx-auto flex justify-center gap-2 lg:mx-0">
                <a
                  href="checkout-payment.php"
                  class="bg-purple-900 px-4 py-2 text-white"
                  >Previous step</a
                >

                <a
                  href="checkout-confirmation.php"
                  class="bg-amber-400 px-4 py-2"
                  >Place Order</a
                >
              </div>
            </div>
          </section>
          <!-- /form  -->

          <!-- Summary  -->

          <section class="mx-auto w-full px-4 md:max-w-[400px]">
            <div class="">
              <div class="border py-5 px-4 shadow-md">
                <p class="font-bold">ORDER SUMMARY</p>

                <div class="flex justify-between border-b py-5">
                  <p>Subtotal</p>
                  <p>$<?php echo $total_price ?></p>
                </div>

                <div class="flex justify-between border-b py-5">
                  <p>Shipping</p>
                  <p>Free</p>
                </div>

                <div class="flex justify-between py-5">
                  <p>Total</p>
                  <p>$<?php echo $total_price ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>

        <!-- /Summary -->

        <!-- Cons bages -->

        <section
          class="container mx-auto my-8 flex flex-col justify-center gap-3 lg:flex-row"
        >
          <!-- 1 -->

          <div
            class="mx-5 flex flex-row items-center justify-center border-2 border-yellow-400 py-4 px-5"
          >
            <div class="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6 text-violet-900 lg:mr-2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"
                />
              </svg>
            </div>

            <div class="ml-6 flex flex-col justify-center">
              <h3 class="text-left text-xs font-bold lg:text-sm">
                Free Delivery
              </h3>
              <p class="text-light text-center text-xs lg:text-left lg:text-sm">
                Orders from $200
              </p>
            </div>
          </div>

          <!-- 2 -->

          <div
            class="mx-5 flex flex-row items-center justify-center border-2 border-yellow-400 py-4 px-5"
          >
            <div class="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6 text-violet-900 lg:mr-2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"
                />
              </svg>
            </div>

            <div class="ml-6 flex flex-col justify-center">
              <h3 class="text-left text-xs font-bold lg:text-sm">
                Money returns
              </h3>
              <p class="text-light text-left text-xs lg:text-sm">
                30 Days guarantee
              </p>
            </div>
          </div>

          <!-- 3 -->

          <div
            class="mx-5 flex flex-row items-center justify-center border-2 border-yellow-400 py-4 px-5"
          >
            <div class="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6 text-violet-900 lg:mr-2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                />
              </svg>
            </div>

            <div class="ml-6 flex flex-col justify-center">
              <h3 class="text-left text-xs font-bold lg:text-sm">
                24/7 Supports
              </h3>
              <p class="text-light text-left text-xs lg:text-sm">
                Consumer support
              </p>
            </div>
          </div>
        </section>

        <!-- /Cons bages  -->
      </div>
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
