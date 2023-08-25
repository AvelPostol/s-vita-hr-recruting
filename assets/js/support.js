export async function support(app, event) {

  const openDialogButtons = document.querySelectorAll('.exto1 .ex');
  let clickedOnOpenDialogButton = false;

  openDialogButtons.forEach(button => {
    if (button.contains(event.target)) {
      clickedOnOpenDialogButton = true;
    }
  });

  if (clickedOnOpenDialogButton) {
    await app.$store.dispatch('TOGGLE_DIALOG', true);
  }

  return clickedOnOpenDialogButton;
}

export async function handleAppClick(app, event) {
  if (app.popup) {
    const dialogElement = app.$refs.dialogRef.$el;
    if (app.$store.state.dialogVisible && (!dialogElement.contains(event.target))) {
      await app.$store.dispatch('TOGGLE_DIALOG', false);
    }
  }
}


export async function LentClick() {
  const parentElement = document.querySelector('.section-cont-v2');
  parentElement.addEventListener('click', event => {
    const sectionB = event.target.closest('.section-b');
    if (!sectionB) return;

    const sectionC = sectionB.parentNode.querySelector('.section-c');
    const imag = sectionB.querySelector('img.sec-ic-arr');
    const secTexti = sectionB.querySelector('.sec-texti');
    
    sectionC.style.display = sectionB.classList.toggle('acti') ? 'block' : 'none';
    imag.classList.toggle('no-deg', !sectionB.classList.contains('acti'));
    imag.classList.toggle('deg', sectionB.classList.contains('acti'));
    secTexti.innerHTML = sectionB.classList.contains('acti') ? 'Свернуть список' : 'Узнать больше';

    sectionB.parentNode.querySelectorAll('.section-b').forEach(elem => {
      if (elem !== sectionB) {
        elem.classList.remove('acti');
        elem.querySelector('.sec-texti').innerHTML = 'Узнать больше';
        elem.parentNode.querySelector('.section-c').style.display = 'none';
      }
    });
  });
}
