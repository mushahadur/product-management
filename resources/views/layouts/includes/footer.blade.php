 <!-- Scroll to top button -->
 <button aria-label="Scroll to top"
 class="fixed bottom-6 right-6 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white p-3 rounded-full shadow-lg transition-opacity opacity-0 pointer-events-none z-50"
 id="scroll-top-btn" title="Scroll to top">
 <i class="fas fa-arrow-up"></i>
</button>
<!-- Footer -->
<footer
 class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 transition-colors duration-500">
 <div
     class="container mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-gray-600 dark:text-gray-300 text-sm">
     <p class="mb-4 md:mb-0">
         © 2024 COmpany-name. All rights reserved.
     </p>
     <div class="flex space-x-6">
         <a aria-label="Facebook" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition"
             href="#">
             <i class="fab fa-facebook-f"></i>
         </a>
         <a aria-label="Twitter" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition"
             href="#">
             <i class="fab fa-twitter"></i>
         </a>
         <a aria-label="Instagram" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition"
             href="#">
             <i class="fab fa-instagram"></i>
         </a>
         <a aria-label="LinkedIn" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition"
             href="#">
             <i class="fab fa-linkedin-in"></i>
         </a>
     </div>
 </div>
</footer>
<script>
 // Mobile menu toggle
 const btn = document.getElementById('mobile-menu-button');
 const menu = document.getElementById('mobile-menu');

 btn.addEventListener('click', () => {
     menu.classList.toggle('hidden');
 });

 // Dark/light mode toggle
 const themeToggleBtn = document.getElementById('theme-toggle');
 const themeIcon = document.getElementById('theme-icon');

 // Check local storage or system preference
 function isDarkMode() {
     return document.documentElement.classList.contains('dark');
 }

 function setIcon() {
     if (isDarkMode()) {
         themeIcon.classList.remove('fa-moon');
         themeIcon.classList.add('fa-sun');
     } else {
         themeIcon.classList.remove('fa-sun');
         themeIcon.classList.add('fa-moon');
     }
 }

 // Initialize icon on load
 if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia(
         '(prefers-color-scheme: dark)').matches)) {
     document.documentElement.classList.add('dark');
 } else {
     document.documentElement.classList.remove('dark');
 }
 setIcon();

 themeToggleBtn.addEventListener('click', () => {
     document.documentElement.classList.toggle('dark');
     if (isDarkMode()) {
         localStorage.setItem('theme', 'dark');
     } else {
         localStorage.setItem('theme', 'light');
     }
     setIcon();
 });

 // Scroll to top button
 const scrollBtn = document.getElementById('scroll-top-btn');

 window.addEventListener('scroll', () => {
     if (window.scrollY > 300) {
         scrollBtn.classList.remove('opacity-0', 'pointer-events-none');
     } else {
         scrollBtn.classList.add('opacity-0', 'pointer-events-none');
     }
 });

 scrollBtn.addEventListener('click', () => {
     window.scrollTo({
         top: 0,
         behavior: 'smooth'
     });
 });
</script>