const scrool = () => { 
  var sidebar = document.getElementById("aside")
  var container_home = document.getElementById("container-home")
  var product_box = document.getElementById("product-box")

  //getBoundingClientRect is function to get distance between top of page and element
  if(container_home.getBoundingClientRect().top <= 0 && window.innerWidth >= 740){
    sidebar.style = "position:fixed;top:0px;padding-top:0px;z-index:99;height:100vh;";
    container_home.style = "position:relative"
    product_box.style = "width:calc(100% - 290px);position:absolute;right:1px;"
  }else{
    sidebar.style = "position:static;padding-top:0px"
    product_box.style = "position:static;"    
  }
}
scrool();
window.addEventListener("scroll", scrool ); 