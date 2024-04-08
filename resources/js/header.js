export function toggleNavList(){
  const navList = document.getElementById("nav-list");
  navList.classList.toggle('hidden');
  
  const showBtn = document.getElementById("show-nav-list");
  showBtn.classList.toggle('hidden');

  const hideBtn = document.getElementById("hide-nav-list");
  hideBtn.classList.toggle('hidden');
}
