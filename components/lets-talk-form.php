<?php

/**
 * Created on Mon Nov 27 2023
 * Author: Connor Doman
 */

?>
<div id="lets-talk" class="fixed top-0 left-0 w-screen h-screen bg-black z-[200] flex flex-col justify-start items-center text-white overflow-y-scroll py-8 pointer-events-none opacity-0 transition-opacity duration-500 ease-in-out">
    <a id="lets-talk-close" href="#close" class="absolute top-2 right-0 m-8 text-xl font-bold"><i class="fa fa-x"></i></a>
    <h1 class="font-syne my-12 mx-4 text-7xl font-bold">Ready to chat?</h1>
    <form class="flex flex-col justify-center items-center gap-4 text-md w-full px-4 py-8 max-w-csek-max">
        <div class="flex flex-col md:flex-row gap-4 w-full">
            <input type="text" placeholder="First name" class="border border-white rounded-lg py-2 px-6 bg-transparent md:w-1/2" />
            <input type="text" placeholder="Last name" class="border border-white rounded-lg py-2 px-6 bg-transparent md:w-1/2" />
        </div>
        <div class="flex flex-col gap-4 w-full">
            <input type="text" placeholder="Email" class="border border-white rounded-lg py-2 px-6 bg-transparent md:w-full" />
            <input type="text" placeholder="Phone" class="border border-white rounded-lg py-2 px-6 bg-transparent md:w-full" />
        </div>
        <select placeholder="Service of interest" class="border border-white rounded-lg py-2 px-6 bg-transparent w-full">
            <option value="" disabled selected>Service of interest</option>
            <option value="2">Another choice</option>
        </select>
        <textarea placeholder="Message (optional)" class="border border-white rounded-lg py-2 px-6 bg-transparent w-full h-32"></textarea>
        <button class="rounded-full bg-csek-red text-white font-bold py-4 px-8">Send an inquiry</button>
    </form>
</div>