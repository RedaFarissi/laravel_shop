const scroll_function = () => {
    var sidebar = document.getElementById("aside")
    var container_home = document.getElementById("container-home")
    var product_box = document.getElementById("product-box")
  
    //getBoundingClientRect is function to get distance between top of page and element
    if(container_home.getBoundingClientRect().top <= 0 && window.innerWidth >= 1024){
      sidebar.style = "position:fixed;top:0px;padding-top:0px;z-index:99;height:100vh;";
      container_home.style = "position:relative"
      product_box.style = "width:calc(100% - 236px);position:absolute;right:1px;"
    }else{
      sidebar.style = "position:static;padding-top:0px"
      product_box.style = "position:static;"
    }
}
scroll_function();
window.addEventListener("scroll", scroll_function);




window.document.getElementById('profile_to_click').addEventListener("click",(event)=>{
  ( window.getComputedStyle(document.getElementById("profile-drop")).getPropertyValue('display')  === "none" )? document.getElementById("profile-drop").style = "display:block" :document.getElementById("profile-drop").style= "display:none";
  event.stopPropagation()
})


function fa_lock_over(){
  document.getElementById("is_superuser_box").style.display = "block"
}

function fa_lock_out(){
  document.getElementById("is_superuser_box").style.display = "none"
}

function remove_profile(){
  document.getElementById("profile-drop").style= "display:none";
}