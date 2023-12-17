console.log(`

░█▀▀░█▀█░▀█▀░█▀▄░█░█░█░░░█▀▀
░▀▀█░█▀▀░░█░░█▀▄░█░█░█░░░█▀▀
░▀▀▀░▀░░░▀▀▀░▀░▀░▀▀▀░▀▀▀░▀▀▀

`)
document.addEventListener('DOMContentLoaded', () => {
    const flashbag = document.querySelector('#flashbag');
    if( flashbag )
    {
        setTimeout(() => {
            flashbag.remove();
        }, 3600)
    }
})