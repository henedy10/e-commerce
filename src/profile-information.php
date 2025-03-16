<?php 
include "user.php";
$connect= new DataBase();
$checkemail= isset($_SESSION['email'])? $_SESSION['email']:null;
$message="";

$user = new User();
$checkname=$user -> checkname();

if(isset($_POST['save'])){
  $message = $user->info($_POST['image'],$_POST['first_name'],$_POST['last_name'],$_POST['bio']);
}

if($checkemail!=null){
  $sql="SELECT first_name,last_name,bio FROM account WHERE email='$checkemail'";
  $result=mysqli_query($connect->connect,$sql);
  $row=mysqli_fetch_assoc($result);
}

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
    <title>Profile information</title>
  </head>

  <body x-data="{ desktopMenuOpen: false, mobileMenuOpen: false}">
    <main class="h-screen flex flex-col justify-between">
      <!-- Header -->
      <div>
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

            <li class="text-gray-500">Account</li>
          </ul>
        </nav>
        <!-- /breadcrumbs  -->
      </div>

      <section
        class="container flex-grow mx-auto max-w-[1200px] border-b py-5 lg:flex lg:flex-row lg:py-10"
      >
        <!-- sidebar  -->
        <section class="hidden w-[300px] flex-shrink-0 px-4 lg:block">
          <div class="border-b py-5">
            <div class="flex items-center">
              <img
                width="40px"
                height="40px"
                class="rounded-full object-cover"
                src="./assets/images/avatar-photo.png"
                alt="Red woman portrait"
              />
              <div class="ml-5">
                <p class="font-medium text-gray-500">Hello,</p>
                <p class="font-bold"><?php echo $checkname ?></p>
              </div>
            </div>
          </div>

          <div class="flex border-b py-5">
            <div class="w-full">
              <div class="flex w-full">
                <div class="flex flex-col gap-2">
                  <a
                    href="account-page.php"
                    class="flex items-center gap-2 font-medium"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-5 w-5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"
                      />
                    </svg>
                    Manage account</a
                  >
                  <a
                    href="profile-information.php"
                    class="text-violet-900 duration-100"
                    >Profile information</a
                  >
                  <a
                    href="manage-address.php"
                    class="text-gray-500 duration-100 hover:text-yellow-400"
                    >Manage Addresses</a
                  >
                  <a
                    href="change-password.php"
                    class="text-gray-500 duration-100 hover:text-yellow-400"
                    >Change password</a
                  >
                </div>
              </div>
            </div>
          </div>

          <div class="flex border-b py-5">
            <div class="flex w-full">
              <div class="flex flex-col gap-2">
                <a
                  href="my-order-history.php"
                  class="flex items-center gap-2 font-medium active:text-violet-900"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="h-5 w-5"
                  >
                    <path
                      d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z"
                    />
                    <path
                      fill-rule="evenodd"
                      d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z"
                      clip-rule="evenodd"
                    />
                  </svg>

                  My Order History</a
                >
              </div>
            </div>
          </div>

          <div class="flex border-b py-5">
            <div class="flex w-full">
              <div class="flex flex-col gap-2">
                <a
                  href="payment-methods.php"
                  class="flex items-center gap-2 font-medium active:text-violet-900"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-5 w-5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"
                    />
                  </svg>

                  Payment Methods</a
                >
              </div>
            </div>
          </div>

          <div class="flex border-b py-5">
            <div class="flex w-full">
              <div class="flex flex-col gap-2">
                <a
                  href="wishlist.php"
                  class="flex items-center gap-2 font-medium active:text-violet-900"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-5 w-5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                    />
                  </svg>

                  My Wishlist</a
                >
              </div>
            </div>
          </div>

          <div class="flex py-5">
            <div class="flex w-full">
              <div class="flex flex-col gap-2">
                <a
                  href="#"
                  class="flex items-center gap-2 font-medium active:text-violet-900"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-5 w-5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"
                    />
                  </svg>

                  Log Out</a
                >
              </div>
            </div>
          </div>
        </section>
        <!-- /sidebar  -->

        <!-- form  -->
        <section
          class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10"
        >
          <div class="py-5">
            <div class="w-full">
              <h2>Avatar image</h2>
              <div
                class="mx-auto mb-5 flex flex-row items-center bg-neutral-100 py-5 lg:mx-0 lg:w-1/2"
                >
                <img
                class="ml-5 h-20 w-20 rounded-full"
                src="./assets/images/avatar-photo.png"
                alt="Your Image"
                />
                
                <form class="flex w-full flex-col gap-3" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                  <div>
                    <label class="block">
                      <span class="sr-only">Choose profile photo</span>
                      <input
                        type="file"
                        name="image"
                        class="mx-auto ml-5 flex w-full justify-center border-yellow-400 text-sm outline-none file:mr-4 file:bg-amber-400 file:py-2 file:px-4 file:text-sm file:font-semibold"
                      />
                    </label>
                  </div>
              </div>
            </div>

              <div class="flex w-full flex-col">
                <label class="flex" for="first name"
                  >First Name<span
                    class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"
                  ></span
                ></label>
                <input
                  class="w-full border px-4 py-2 lg:w-1/2"
                  type="text"
                  name="first name"
                  id="first name"
                  value="<?php
                    if($checkemail!=null)
                    echo $row['first_name']
                  ?>"
                  placeholder="First Name"
                />
              </div>

              <div class="flex w-full flex-col">
                <label class="flex" for="last name"
                  >Last Name<span
                    class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"
                  ></span
                ></label>
                <input
                  class="w-full border px-4 py-2 lg:w-1/2 "
                  type="text"
                  name="last name"
                  id="last name"
                  value="<?php 
                  if($checkemail!=null)
                  echo $row['last_name'];
                  ?>"
                  placeholder="Last Name"
                />
              </div>

              <div class="flex flex-col">
                <label for="Bio">Bio</label>
                <textarea
                  class="w-full border px-4 py-2 text-gray-500 outline-none lg:w-1/2"
                  name="bio"
                  id="Bio"
                  cols="30"
                  rows="10"
                  placeholder="Write Your Bio...."
                ><?php
                  if($checkemail!=null)
                  echo $row['bio'];
                  ?></textarea>

                <button class="mt-4 w-40 bg-violet-900 hover:bg-violet-700 px-4 py-2 text-white cursor-pointer rounded-lg" type="save" name="save">
                  Save changes
                </button>
                <span class=" mt-5 bg-green-500 font-bold text-center"><?php echo $message ?></span>
              </div>
            </form>
          </div>
        </section>
        <!-- /form  -->
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
