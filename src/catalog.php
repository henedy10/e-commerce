<?php 
session_start();
include "db.php";
$quantity=1 ;
$total_price=0;
$message="";
$check=new DataBase();
$connect = $check->connect;
$sql="SELECT id FROM products";
$result=mysqli_query($connect,$sql);
$row=mysqli_num_rows($result);
$email=isset($_SESSION['email']) ? $_SESSION['email']:null;

// info about product

if(isset($_POST['info_product'])){
  $_SESSION['id_product']=$_POST['info_product'];
  header("location: product-overview.php");
}

// ADD TO CART 

if(isset($_POST['add_to_cart'])){
  if($email==null){
    $message="You should log in first Or create an account!";
  }else{
    $id = $_POST['add_to_cart'];

    $sql_catalog = "SELECT *FROM products WHERE id='$id'";
    $result_catalog = mysqli_query($connect,$sql_catalog);
    $row_catalog = mysqli_fetch_assoc($result_catalog);

    $price_catalog = $row_catalog['new_price'];
    $image_catalog = $row_catalog['image'];
    $name_catalog = $row_catalog['name'];
    $total_price = $price_catalog * $quantity;

    $sql_cart="SELECT image FROM cart WHERE image='$image_catalog' AND email='$email'";
    $result_cart = mysqli_query($connect,$sql_cart);
    
    if(mysqli_num_rows($result_cart)>0){
      $message="This product is added before already";
    }else{
      $sql_cart="INSERT INTO cart (email,quantity,price,total_price,image,name) 
                              VALUES('$email','$quantity','$price_catalog',
                                    '$total_price','$image_catalog','$name_catalog')";
      $result_cart = mysqli_query($connect,$sql_cart);
      if($result_cart){
        $message = "Addition to your cart is done successfully";
      }
    }
  }
}
// END OF ADD OF CART


// ADD OF WISHLIST

elseif(isset($_POST['wishlist'])){
  
  if($email==null){
    $message="You should log in first Or create an account!";
  }else{
    $id = $_POST['wishlist'];
  
    $sql_catalog = "SELECT name,new_price,image FROM products WHERE id='$id'";
    $result_catalog = mysqli_query($connect,$sql_catalog);
    $row_catalog = mysqli_fetch_assoc($result_catalog);
  
    $price_catalog = $row_catalog['new_price'];
    $image_catalog = $row_catalog['image'];
    $name_catalog = $row_catalog['name'];
  
    $sql_cart="SELECT image FROM wishlist WHERE image='$image_catalog' AND email='$email'";
    $result_cart = mysqli_query($connect,$sql_cart);
    
    if(mysqli_num_rows($result_cart)>0){
      $message="This product is added before already";
    }else{
      $sql_wishlist="INSERT INTO wishlist (email,price,image,name) 
                              VALUES('$email','$price_catalog','$image_catalog','$name_catalog')";
      $result_wishlist = mysqli_query($connect,$sql_wishlist);
      if($result_wishlist){
        $message = "Addition to your wishlist is done successfully";
      }
    }
  }
}
// END OF ADD OF WISHLIST

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
    <script
    defer
    src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"
    ></script>
    <meta name="theme-color" content="#ffffff" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Catalog</title>
  </head>
  
  <body x-data="{ desktopMenuOpen: false, mobileMenuOpen: false}">
    <main class="flex flex-col h-screen justify-between">
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
          <ul class="flex justify-between">
            <div class="flex ">
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
              
              <li class="text-gray-500">Catalog</li>
            </div>
            <div class=" text-center font-bold w-1/2">
              <li class="bg-green-300"><?php echo $message ?></li>
            </div>
          </ul>
        </nav>
        <!-- /breadcrumbs  -->
      </div>

      <section
      class="container mx-auto flex-grow max-w-[1200px] border-b py-5 lg:flex lg:flex-row lg:py-10"
      >
      <!-- sidebar  -->
      <section class="hidden w-[300px] flex-shrink-0 px-4 lg:block">
          <div class="flex border-b pb-5">
            <div class="w-full">
              <p class="mb-3 font-medium">CATEGORIES</p>
              
              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">Bedroom</p>
                </div>
                <div>
                  <p class="text-gray-500">(12)</p>
                </div>
              </div>
              
              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">Sofa</p>
                </div>
                <div>
                  <p class="text-gray-500">(15)</p>
                </div>
              </div>
              
              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">Office</p>
                </div>
                <div>
                  <p class="text-gray-500">(14)</p>
                </div>
              </div>
              
              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">Outdoor</p>
                </div>
                <div>
                  <p class="text-gray-500">(124)</p>
                </div>
              </div>
            </div>
          </div>

          <div class="flex border-b py-5">
            <div class="w-full">
              <p class="mb-3 font-medium">BRANDS</p>
              
              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">APEX</p>
                </div>
                <div>
                  <p class="text-gray-500">(12)</p>
                </div>
              </div>
              
              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">Call of SOFA</p>
                </div>
                <div>
                  <p class="text-gray-500">(15)</p>
                </div>
              </div>
              
              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">Puff B&G</p>
                </div>
                <div>
                  <p class="text-gray-500">(14)</p>
                </div>
              </div>

              <div class="flex w-full justify-between">
                <div class="flex justify-center items-center">
                  <input type="checkbox" />
                  <p class="ml-4">Fornighte</p>
                </div>
                <div>
                  <p class="text-gray-500">(124)</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="flex border-b py-5">
            <div class="w-full">
              <p class="mb-3 font-medium">PRICE</p>
              
              <div class="flex w-full">
                <div class="flex justify-between">
                  <input
                    x-mask="99999"
                    min="50"
                    type="number"
                    class="h-8 w-[90px] border pl-2"
                    placeholder="50"
                    />
                    <span class="px-3">-</span>
                    <input
                    x-mask="999999"
                    type="number"
                    max="999999"
                    class="h-8 w-[90px] border pl-2"
                    placeholder="99999"
                    />
                  </div>
              </div>
            </div>
          </div>

          <div class="flex border-b py-5">
            <div class="w-full">
              <p class="mb-3 font-medium">SIZE</p>
              
              <div class="flex gap-2">
                <div
                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
                >
                  XS
                </div>
                <div
                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
                >
                  S
                </div>
                <div
                class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
                >
                M
              </div>
              
              <div
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
              >
              L
            </div>

            <div
            class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
            >
            XL
          </div>
        </div>
            </div>
          </div>
          
          <div class="flex py-5">
            <div class="w-full">
              <p class="mb-3 font-medium">COLOR</p>
              
              <div class="flex gap-2">
                <div
                class="h-8 w-8 cursor-pointer border border-white bg-gray-600 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
                ></div>
                <div
                class="h-8 w-8 cursor-pointer border border-white bg-violet-900 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
                ></div>
                <div
                class="h-8 w-8 cursor-pointer border border-white bg-red-900 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500"
                ></div>
              </div>
            </div>
          </div>
        </section>
        <!-- /sidebar  -->
        
        <div>
          <div class="mb-5 flex items-center justify-between px-5">
            <div class="flex gap-3">
              <button class="flex items-center justify-center border px-6 py-2">
                Sort by
                <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="mx-2 h-4 w-4"
                  >
                  <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                  />
                </svg>
              </button>
              
              <button
              class="flex items-center justify-center border px-6 py-2 md:hidden"
              >
              Filters
              <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="mx-2 h-4 w-4"
              >
              <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M19.5 8.25l-7.5 7.5-7.5-7.5"
              />
            </svg>
                </button>
              </div>
              
              <div class="hidden gap-3 lg:flex">
                <button class="border bg-amber-400 py-2 px-2">
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
                  d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"
                  />
                </svg>
              </button>
              
              <button class="border py-2 px-2">
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
                  d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                  />
                </svg>
              </button>
            </div>
          </div>
          
          <section
          class="mx-auto grid max-w-[1200px] grid-cols-2 gap-3 px-5 pb-10 lg:grid-cols-3"
          >
            <?php 
              for($id=1;$id<($row+1);$id++):
              $sql="SELECT *FROM products WHERE id='$id'";
              $result = mysqli_query($connect,$sql);
              $rows=mysqli_fetch_assoc($result);
            ?>
            <div class="flex flex-col">
              <div class="relative flex">
                <img
                class=""
                src="<?php echo $rows['image'] ?>"
                alt="<?php  $rows['name']."image"?>"
                />
                <div
                class="absolute flex h-full w-full items-center justify-center gap-3 opacity-0 duration-150 hover:opacity-100"
                >
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                  <button type="submit" name="info_product" value="<?php  echo $rows['id']?>">
                    <a
                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400"
                    >
                    <svg
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
                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                          />
                        </svg>
                      </a>
                  </button>
                  <button type="submit" name="wishlist" value="<?php  echo $rows['id']?>">
                    <span
                        class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400"
                        >
                          <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          class="h-4 w-4"
                          >
                            <path
                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"
                              />
                          </svg>
                        </span>
                      </button>
                    </form>
                </div>
                <div
                  class="absolute right-1 mt-3 flex items-center justify-center bg-amber-400"
                  >
                  <p class="px-2 py-2 text-sm">&minus; <?php echo $rows['discount'] ?> &percnt; OFF</p>
                </div>
              </div>
              <div>
                <p class="mt-2"><?php echo $rows['name'] ?></p>
                <p class="font-medium text-violet-900">
                <?php echo "$".$rows['new_price'] ?>
                  <span class="text-sm text-gray-500 line-through"
                  ><?php echo "$".$rows['price'] ?></span>
                </p>
                <div class="flex items-center">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-4 w-4 text-yellow-400"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-4 w-4 text-yellow-400"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-4 w-4 text-yellow-400"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-4 w-4 text-yellow-400"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-4 w-4 text-gray-200"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <p class="text-sm text-gray-400">(38)</p>
                </div>
                <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
                  <div>
                    <button class="mt-5 h-10 w-full font-bold bg-violet-900 hover:bg-violet-700 text-white rounded-lg cursor-pointer" 
                            type="submit"
                            name="add_to_cart"
                            value="<?php echo $rows['id'] ?>">
                      Add to cart
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <?php endfor; ?>
          </div>
        </section>
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

