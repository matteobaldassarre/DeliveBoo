const tl = new TimelineLite();

// const drawer = document.getElementById("drawer");
// const main = document.getElementById("main");
// const drawerVeil = document.getElementById("drawer-veil");
// const header = document.getElementById("header");
// const toggle = document.getElementById("toggle");
// const closeDrawerBtn = document.getElementById("close-drawer-btn");

// // if the drawer is open or not
// let openDrawer = false;

// tl
//   .from(drawer, 0.25, { x: 0, ease: Power1.easeOut })
//   .from(header, 0.25, { marginRight: 240, ease: Power1.easeOut, force3D: true }, 0)
//   .from(main, 0.25, { marginRight: 240, ease: Power1.easeOut, force3D: true }, 0)
//   .from(drawerVeil, 0.15, { autoAlpha: 0.5 }, 0)
//   .from(main, 0.15, { autoAlpha: 0.5 }, 0)
//   .reverse();

// toggle.onclick = () => {
//   openDrawer = tl.reversed();
//   tl.reversed( !tl.reversed() );
//   toggle.style.display = "none";
// };

// const reverseDrawerTween = () => {
//   tl.reverse();
//   openDrawer = tl.reversed();
//   toggle.style.removeProperty('display');
// };

// drawerVeil.onclick = reverseDrawerTween;
// closeDrawerBtn.onclick = reverseDrawerTween;







const drawer = document.getElementById("drawer");
const main = document.getElementById("main");
const drawerVeil = document.getElementById("drawer-veil");
const header = document.getElementById("header");
const toggle = document.getElementById("toggle");
const closeDrawerBtn = document.getElementById("close-drawer-btn");

// if the drawer is open or not
let openDrawer = false;

tl
  .to(drawer, 0.25, { x: 0, ease: Power1.easeOut })
  .to(header, 0.25, { marginLeft: 240, ease: Power1.easeOut, force3D: true }, 0)
  // .to(main, 0.25, { marginLeft: 240, ease: Power1.easeOut, force3D: true }, 0)
  .to(drawerVeil, 0.15, { autoAlpha: 0.5 }, 0)
  .reverse();

toggle.onclick = () => {
  openDrawer = tl.reversed();
  tl.reversed( !tl.reversed() );
  toggle.style.display = "none";
};

const reverseDrawerTween = () => {
  tl.reverse();
  openDrawer = tl.reversed();
  toggle.style.removeProperty('display');
};

drawerVeil.onclick = reverseDrawerTween;
closeDrawerBtn.onclick = reverseDrawerTween;