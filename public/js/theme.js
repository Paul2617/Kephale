  // Appliquer le thème sauvegardé (au chargement)
  const savedTheme = localStorage.getItem('theme');
  const html = document.documentElement;

  if (savedTheme === 'dark' || savedTheme === 'light') {
    html.classList.remove('dark', 'light');
    html.classList.add(savedTheme);
   } else {
    // Détection automatique si aucun thème sauvegardé
    const prefersDark = window.matchMedia('(prefers-color-scheme: light)').matches;
    html.classList.add(prefersDark ? 'dark' : 'light');
  }

  // Fonction de bascule du thème + sauvegarde
  function toggleTheme() {
    const isDark = html.classList.contains('dark');
    html.classList.toggle('dark', !isDark);
    html.classList.toggle('light', isDark);
    localStorage.setItem('theme', isDark ? 'light' : 'dark');
 }