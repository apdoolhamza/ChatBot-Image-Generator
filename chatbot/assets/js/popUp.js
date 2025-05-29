// create new Element "div"
const popUpContainer = document.createElement('div');

// set "popUpContainer" Class attribute with value 'pop-up'
popUpContainer.setAttribute('class','pop-up');

// set it childs Elements Including 'Icons, popBody, popTitle...'
popUpContainer.innerHTML = '<i class="fas exclamIcon fa-circle-exclamation"></i> <div class="popBody"><h3 class="popTitle"></h3> <p class="popDesc"></p></div> <i class="fas closeIcon fa-xmark"></i>';

// append (marge) popUpContainer to the body
document.querySelector('body').append(popUpContainer);

// Call some popUpContainer childs
const popTitle = popUpContainer.querySelector('.popTitle');
const popDesc = popUpContainer.querySelector('.popDesc');
const exclamIcon = popUpContainer.querySelector('.exclamIcon');
const closeIcon = popUpContainer.querySelector('.closeIcon');


closeIcon.addEventListener('click', () => {
    popUpContainer.style.display = "none";
})

// function which allow to manipulate and customize 'popUpContainer'
const popUp = (title,body) => {
    popUpContainer.style.display = "flex";
    popTitle.innerHTML = title;
    popDesc.innerHTML = body;
    let tomatcherror = /Error|Offline/ig;
    if (tomatcherror.test(body) || tomatcherror.test(title)) {
        popUpContainer.style.borderLeft = `4px solid darkred`;
        exclamIcon.style.color = 'darkred';    
    } else {
        // popUpContainer.style.borderLeft = `4px solid darkgreen`;
        // exclamIcon.style.color = 'darkgreen';  
        popUpContainer.style.borderLeft = `4px solid darkred`;
        exclamIcon.style.color = 'darkred'; 
    }
    if (title === "" && body === "") {
        popUpContainer.style.display = "none";
    }
}

const closePopUp = () => {
    popUpContainer.style.display = "none";
}