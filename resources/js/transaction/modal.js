const modal = document.getElementById("modalProduk");
const btnOpen = document.getElementById("btnTambahProduk");
const btnClose = document.getElementById("closeModal");

export function openModal() {

    modal.classList.remove("hidden");
    modal.classList.add("flex");

}

export function closeModal() {

    modal.classList.remove("flex");
    modal.classList.add("hidden");

}

if(btnOpen){

    btnOpen.onclick = openModal;

}

if(btnClose){

    btnClose.onclick = closeModal;

}

window.addEventListener("click",(e)=>{

    if(e.target===modal){

        closeModal();

    }

});