export function sleep(ms) {
    /**]
     *  Pause function
     */

    return new Promise(resolve => setTimeout(resolve, ms));
}

export function getCookie(name){
    /**
    * Grab cookie by name from local storage
    */
  
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }
  
  export function deleteCookie(name){
    /**
     * Delete cookie from local storage
     */
  
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }
  
  export function setCookie(name, value, days){
    /**
     * Store cookie by name by local storage
     */
  
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }