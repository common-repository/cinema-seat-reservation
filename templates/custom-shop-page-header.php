<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Name: Custom Single Product
 */
get_header();
$home = home_url();
$plugin_uri = plugins_url('/', __FILE__);
$logo_image_not_ava = $plugin_uri.'images/logo_image_not_ava.jpg';
?>

<style>
  .container_csrmplugin {
  max-width: 1200px;
  margin: 0 auto;
  display: flex !important;
  
}

/* Columns */
.left-column_csrmplugin {
  width: 40%;
  position: relative;
  padding: 20px;
}

.right-column_csrmplugin {
  width: 60%;
  text-align: center;
  margin-top: 10px;
}


/* Product Description */
.product-description_csrmplugin {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 20px;
}
.product-description_csrmplugin span {
  font-size: 12px;
  color: #358ED7;
  letter-spacing: 1px;
  text-transform: uppercase;
  text-decoration: none;
}
.product-description_csrmplugin h1 {
  font-weight: 300;
  font-size: 52px;
  color: #43484D;
  letter-spacing: -2px;
}
.product-description_csrmplugin p {
  font-size: 16px;
  font-weight: 300;
  color: #86939E;
  line-height: 24px;
}

/* Product Configuration */
.product-color_csrmplugin span,
.cable-config_csrmplugin  {
  font-size: 14px;
  font-weight: 400;
  color: #000;
  margin-bottom: 20px;
  display: inline-block;
}

/* Product Color */
.product-color_csrmplugin {
  margin-bottom: 30px;
}

.color-choose_csrmplugin div {
  display: inline-block;
}

.color-choose_csrmplugin input[type="radio"] {
  display: none;
}

.color-choose_csrmplugin input[type="radio"] + label span {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
}

.color-choose_csrmplugin input[type="radio"] + label span {
  border: 2px solid #FFFFFF;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
}

.color-choose_csrmplugin input[type="radio"]#red + label span {
  background-color: #C91524;
}
.color-choose_csrmplugin input[type="radio"]#blue + label span {
  background-color: #314780;
}
.color-choose_csrmplugin input[type="radio"]#black + label span {
  background-color: #323232;
}

.color-choose_csrmplugin input[type="radio"]:checked + label span {
  background-image: url(images/check-icn.svg);
  background-repeat: no-repeat;
  background-position: center;
}

/* Cable Configuration */
.cable-choose_csrmplugin {
  margin-bottom: 20px;
}

.button_seats_choose_csrmplugin {
  border:1px solid #000 !important; 
  border-radius: 6px;
  padding: 13px 20px;
  font-size: 14px;
  color: #5E6977;
  background-color: #fff;
  cursor: pointer;
  transition: all .5s;
  margin-top: 10px;

}

.button_seats_choose_csrmplugin:hover {
  background-color: #ccc !important;
}
.button_seats_choose_csrmplugin:focus{
background-color: #ccc !important;
border:1px solid #000 !important;   
}



.cable-config_csrmplugin a {
  color: #358ED7;
  text-decoration: none;
  font-size: 12px;
  position: relative;
  margin: 10px 0;
  display: inline-block;
}
.cable-config_csrmplugin a:before {
  content: "?";
  height: 15px;
  width: 15px;
  border-radius: 50%;
  border: 2px solid rgba(53, 142, 215, 0.5);
  display: inline-block;
  text-align: center;
  line-height: 16px;
  opacity: 0.5;
  margin-right: 5px;
}

/* Product Price */
.product-price_csrmplugin {
  display: flex;
  align-items: center;
}

.product-price_csrmplugin span {
  font-size: 26px;
  font-weight: 300;
  color: #43474D;
  margin-right: 20px;
}

.cart-btn_csrmplugin {
  display: inline-block;
  background-color: #7DC855;
  border-radius: 6px;
  font-size: 16px;
  color: #FFFFFF;
  text-decoration: none;
  padding: 12px 30px;
  transition: all .5s;
}
.cart-btn_csrmplugin:hover {
  background-color: #64af3d;
}

/* Responsive */
@media (max-width: 940px) {
  .container_csrmplugin {
    flex-direction: column;
    margin-top: 60px;
  }

  .left-column_csrmplugin,
  .right-column_csrmplugin {
    width: 100%;
  }

  .left-column_csrmplugin img {
    width: 300px;
    height: 100px;
    right: 0;
    top: -65px;
    left: initial;
  }
}

@media (max-width: 535px) {
  .left-column_csrmplugin img {
    width: 150px;
    height: 150px;
    top: -85px;
  }
}
 input[type="checkbox"] {
      display: none;
    }

    /* Style for the label to make it look clickable */
    label {
      cursor: pointer;
      padding: 15px;
      border: 1px solid #3f5bbb;
      display: inline-block;
      margin-top: 10px;
    }
  

    table{
      border-width: 1px 1px 1px 1px ;
    }
    /* Style for the label when the checkbox is checked */
    input[type="checkbox"]:checked + label {
    background-color: #71e746;
    color: #fff;
    border: 1px solid green;
}
    .cable-choose_csrmplugin{
      user-select: none;
    }
    .custom_quantity{
      display: none !important;
    }
   .available_seat_button {
    margin: 10px;
    background-color: #81bded !important;
    color: #000 !important;
    border-radius: 7px !important;
    border: 1px solid #104e8d !important;
}
    .date_input_available_seat{
      height: 45px !important;
      width: 300px !important;
      border-radius: 10px !important;
      border:1px solid #0854c1 !important;
      padding-left: 10px !important;
      padding-right: 10px !important;
    }
    .date_input_available_seat:focus{
      outline: none;
      height: 45px !important;
      width: 300px !important;
      border-radius: 10px !important;
      border:1px solid #0854c1 !important;
      padding-left: 10px !important;
      padding-right: 10px !important;
    }
    
    .available_seat_button:hover{
      background-color: #67a8e5 !important;
    }
    .book{
    color: 000 !important;
    background-color: #ebd4d4;
    cursor: pointer;
    padding: 15px !important;
    border: 1px solid #ccc;
    display: inline-block;
    margin-top: 10px;
}
</style>
<?php
