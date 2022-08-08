export function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

export function yugioh(){
    console.log("I play yugioh");
}