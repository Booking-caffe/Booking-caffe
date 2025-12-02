<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Cafe Admin Login</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&amp;family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet"/>
<style>
        
    </style>
<script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#6B4F4B",
              "background-light": "#F5EFE6",
              "background-dark": "#2C2C2C",
            },
            fontFamily: {
              display: ["Playfair Display", "serif"],
              sans: ["Roboto", "sans-serif"]
            },
            borderRadius: {
              DEFAULT: "0.5rem",
            },
          },
        },
      };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-sans text-slate-800 dark:text-slate-300 antialiased transition-colors duration-300">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md perspective-card">
      <div class="bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm rounded-lg shadow-2xl p-8 transform transition-all duration-500">
        <div class="text-center mb-8">
          <h1 class="font-display text-4xl font-bold text-primary">Cafe Admin</h1>
          <p class="text-slate-600 dark:text-slate-400 mt-2">Welcome back, please log in.</p>
        </div>
        <form action="#" class="space-y-6" method="POST">
          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1" for="username">Username</label>
            <input class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary/50 transition duration-200" id="username" name="username" required="" type="text"/>
          </div>
          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1" for="password">Password</label>
            <input class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary/50 transition duration-200" id="password" name="password" required="" type="password"/>
          </div>
          <div>
            <button class="w-full bg-primary text-white font-bold py-3 px-4 rounded hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:ring-offset-background-light dark:focus:ring-offset-background-dark shadow-lg hover:shadow-primary/40 transform hover:-translate-y-0.5 transition-all duration-300" type="submit">Login</button>
          </div>
        </form>
        <div class="mt-8 text-center">
          <p class="text-xs text-slate-500 dark:text-slate-500">Hak Cipta © 2025. Cafe Management System.</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>