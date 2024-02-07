const SECTIONS = [... document.querySelectorAll('.container-section')];
const NAV_LINKS = [... document.querySelectorAll('aside a:not(.link)')];
const LINKS = [...document.querySelectorAll(':is(aside, #links, .burger-links) a:not(.link)')];
const scrollArrow = document.getElementById('scroll-arrow');
const backToTop = document.getElementById('back-to-top');
const burger = document.querySelector('.burger-menu');
const burger_content = burger.querySelector('.animated-burger');
const spinner = document.querySelector('.spinner-backdrop');

window.onload = () => {
    spinner.classList.add('hidden');
}

// $( document ).ready( function() {

    let data = SECTIONS.map(section => section.offsetTop-32 );

    const RESIZE_OBSERVER = new ResizeObserver(handleResize);
    RESIZE_OBSERVER.observe(document.querySelector('main'));

    const nav_length = SECTIONS.length;
    const range = [...Array(nav_length).keys()];

    LINKS.forEach((link) => {
        const i = [...link.parentNode.children].indexOf(link);
        link.onclick = (e) => {
            e.preventDefault();
            if(range.includes(i)) {
                window.scrollTo({
                    top: data[i],
                    behavior: 'smooth',
                });
                if(link.parentNode.classList.contains('burger-links') && document.querySelector('.animated-burger input:checked')) {
                    document.querySelector('.animated-burger input:checked').click();
                }
            }
        }
    });

    let saved_index; // stockage de l'index de l'élément selectionné

    window.onscroll = handleScroll;

    function handleScroll() { // fonction lors du défillement
        const SCROLLED = window.scrollY + (window.innerHeight/2); // déterminer niveau du trigger
        const scrollArrowHasClass = scrollArrow.classList.contains('hidden');
        for(const i of data) {
            if(SCROLLED <= data[0] - window.innerHeight/1.75 && scrollArrowHasClass) {
                scrollArrow.classList.remove('hidden');
            } else if(SCROLLED >= data[0] - window.innerHeight/1.75 && !scrollArrowHasClass) {
                scrollArrow.classList.add('hidden');
            }
            if(SCROLLED < data[0]) {
                backToTop.classList.remove("show");
            } else {
                backToTop.classList.add("show");
            }
            if (SCROLLED >= (burger.offsetTop + window.innerHeight/2 + 72)) 
                burger_content.classList.add('fixed');
            else 
                burger_content.classList.remove('fixed');

            const index = data.indexOf(i);
            if((SCROLLED >= data[index] && SCROLLED < data[index+1]) || (index == data.length-1) && SCROLLED >= data[index]) {
                if(index !== saved_index) {
                    saved_index = index;
                    NAV_LINKS.forEach(nav => {
                        nav.classList.remove('selected');
                    });
                    NAV_LINKS[index].classList.add( "selected" );
                }
                break;
            }
        }
    }

    handleScroll();

    function handleResize() {
        data = SECTIONS.map(section => section.offsetTop-32);
        handleScroll();
    }


    // document.querySelectorAll('a.link').forEach(link => {

    //     const i = link.dataset.target;

    //     link.onclick = (e) => {

    //         if(['0', '1', '2', '3'].includes(i)) {

    //             window.scrollTo({

    //                 top: data[i],

    //                 behavior: "smooth"

    //             });

    //             if(e.target.parentNode.classList.contains('burger-links') && document.querySelector('.animated-burger input:checked')) {

    //                 document.querySelector('.animated-burger input:checked').click();

    //             } 

    //         }

    //     }

    // });







    document.querySelectorAll('.skills .skill img').forEach(sk => {

        const skill_name = sk.parentNode.parentNode.parentNode.querySelector('.skill-name');

        sk.onmouseenter = () => {

            skill_name.innerHTML = sk.parentNode.dataset.name;

            skill_name.style.opacity = 1;

        }

        sk.onmouseleave = () => {

            skill_name.style.opacity = 0;

        }

    });

    

    



    document.getElementById("back-to-top").onclick = () => {

        window.scrollTo({ top: 0, behavior: 'smooth' });

    };





// });



// Changement de thème de couleur

document.getElementById('theme-switcher').onclick = () => {

    const root = document.documentElement;

    const body = document.body;



    body.classList.add('theme-change');



    if (root.dataset.theme !== 'light') { root.dataset.theme = 'light'; localStorage.setItem('light-theme', true); }

    else { root.dataset.theme = 'dark'; localStorage.setItem('light-theme', false); }



    let timeout = setTimeout(() => {

        body.classList.remove('theme-change');

    }, 500);

}



// setTimeout(() => {

//     $( "#loading-screen" ).remove();

// }, 2000);





// Ouvrir une boîte de dialogue

function openDialog(dialog) {

    document.body.style.overflow = "hidden";

    if(typeof(dialog.showModal) !== "function") {

        dialog.classList.add("open");

    } else {

        dialog.showModal();

    }        

}



// Fermer une boîte de dialogue

function closeDialog(dialog) {

    document.body.style.overflow = "auto";

    dialog.remove();

}    



// Taille paragraphes compétences

let tailles = [];

document.querySelectorAll(".skills-list .skills-block .skills").forEach(el => {

    tailles.push(el.clientHeight);

    let max = Math.max(...tailles);

    if(max > el.clientHeight) {

        el.style.height = `${max}px`;

    }

});



// Click sur la flèche en haut de la page

document.getElementById("scroll-arrow").addEventListener("click", function() {

    if(!this.classList.contains("hidden")) {

        window.scrollTo({

            top: document.querySelector(".container-section").offsetTop-32,

            behavior: "smooth"

        });

    }

    

});



// Selection groupe de boutons

const btnGroups = document.querySelectorAll('.btn-group');

btnGroups.forEach(group => {

    const buttons = group.querySelectorAll('button');

    let selectedButtons = group.querySelectorAll('button.selected');

    if (selectedButtons.length === 0) group.children[0].classList.add('selected');

    buttons.forEach((btn, i) => {

        if (!btn.classList.contains('action')) {

            btn.addEventListener('click', () => {

                selectedButtons = group.querySelectorAll('button.selected');

                selectedButtons.forEach(el => { el.classList.remove('selected') });

                btn.classList.add('selected');

            });

        } else {

            btn.onclick = () => {

                window.open(btn.dataset.file, '_blank');

            }

        }

    })

});



const checkboxInput = document.querySelector('.animated-burger input');

checkboxInput.onclick = () => {

    if (checkboxInput.checked) { document.body.style.overflow = 'hidden'; }

    else { document.body.style.overflow = 'auto'; }

}



// const nonClickableButtons = document.querySelectorAll('a:not([href]), .controls, #scroll-arrow');

// nonClickableButtons.forEach(btn => {

//     btn.onkeydown = (e) => {

//         if (e.key === 'Enter') btn.dispatchEvent(new Event('click', {bubbles: true}));

//     }

// });







function scrollToEl(speed, el) {

    const destination = el ? window.pageYOffset + el.getBoundingClientRect().top : 0;

    const start = window.scrollY;

    const distance = Math.abs(destination - start);

    if (distance === 0) { return; }

    const jump = speed ? distance / (speed * 100) : 10;

    // console.log(distance, jump);



    start >= destination ? scrollUp() : scrollDown();



    function scrollUp() {

        let nextPos = start

        for(let i = 0; nextPos >= destination; i++) {

            scroll(nextPos -= jump, i);

        }

    }



    function scrollDown() {

        let nextPos = start

        for(let i = 0; nextPos <= destination; i++) {

            scroll(nextPos += jump, i);

        }

    }



    function scroll(pos, wait) {

        setTimeout(() => {

           window.scrollTo({

                top: pos,

                behavior: 'smooth',

            }); 

        }, wait);

    }

}





























































































































































































































































































































document.querySelector('#footer-social a[role="button"]').onclick = () => {

    const dialog = document.createElement('dialog');

    dialog.style.cssText = `

        height: 90%;

        width: 90%;

        background-color: var(--mainColor);

        margin: auto;

        overflow: hidden;

    `;







    // Vidéo



    const video = document.createElement('video');

    // video.src = 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=0';

    

    const rand = Math.floor(Math.random() * videos.length);

    video.src = videos[rand];



    video.style.cssText = `

        height: 100%;

        width: 100%;

        border: none;

    `;

    dialog.appendChild(video);







    // Bouton



    const close_btn = document.createElement('i');

    const all_pos = ['top-left', 'top-right', 'bottom-left', 'bottom-right'];

    let close_btn_pos = 'top-left';

    close_btn.classList.add('fas', 'fa-times');

    close_btn.style.cssText = 'position: fixed; top: 0px; left: 0px; color: white; padding: 24px; font-size: 24px; cursor: pointer; background: #d3d3d355; border-radius: 8px';

    close_btn.onmouseenter = () => {

        const choosable_pos = all_pos.filter(el => el != close_btn_pos);

        const random = Math.floor(Math.random() * choosable_pos.length);

        const new_pos = choosable_pos[random];

        

        close_btn.style.top = new_pos.includes('top') ? 0 : '';

        close_btn.style.left = new_pos.includes('left') ? 0 : '';

        close_btn.style.bottom = new_pos.includes('bottom') ? 0 : '';

        close_btn.style.right = new_pos.includes('right') ? 0 : '';



        close_btn_pos = new_pos;

    }

    close_btn.onclick = () => {

        alert('Well tried...');

        alert('Now get rickrolled.');

        video.src = '/bourletos2/special/nggyu_true';

        video.volume = 1;

        video.play();

    }



    dialog.appendChild(close_btn);







    dialog.oncancel = (e) => { 

        e.preventDefault();

        alert('You tried to run away, eh ?');

        alert('Time to get louder...');

        video.volume = 1;

        alert('And in a loop we go...');

        video.loop = true;

    }



    document.body.appendChild(dialog);



    alert('Why did you click ?!');

    alert("You just triggered something you don't know anything about....");

    alert("He is the eater of worlds, he's the one who w....");

    alert('Oh no.');

    alert("I hear him coming.");

    alert("Good luck with that, I'm outta here !");



    videoShow();



    function videoShow() {

        video.volume = 0.1;

        video.play();

        openDialog(dialog);

    }



    dialog.addEventListener('close', (e) => {

        dialog.remove();

    });

}