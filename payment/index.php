<!DOCTYPE html>
<html lang="en" >
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="UTF-8">
  <title>AHLAN ANTALYA AhlanAntalya</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css?v=0.1">

      <meta  name="keywords" content="AHLAN ANTALYA" />
      <meta  name="description" content="AHLAN ANTALYA" />
      <meta  itemprop="name" content="AHLAN ANTALYA" />
      <meta  itemprop="description" content="PAYMENT PLATFORM PAGE" />
      <meta  itemprop="image" content="https://ahlanantalya.com.tr/payment/bg2.jpeg" />
      <meta  name="twitter:card" content="product" />
      <meta  name="twitter:site" content="@AHLAN ANTALYA" />
      <meta  name="twitter:title" content="AHLAN ANTALYA" />
      <meta  name="twitter:description" content="PAYMENT PLATFORM PAGE" />
      <meta  name="twitter:creator" content="@AHLAN ANTALYA" />
      <meta  name="twitter:image" content="AHLAN ANTALYA" />
      <meta  property="fb:app_id" content="" />
      <meta  property="og:title" content="AHLAN ANTALYA" />
      <meta  property="og:type" content="article" />
      <meta  property="og:url" content="/" />
      <meta  property="og:image" content="https://ahlanantalya.com.tr/payment/bg2.jpeg" />
      <meta  property="og:description" content="PAYMENT PLATFORM PAGE" />
      <meta  property="og:site_name" content="AHLAN ANTALYA" />
      
      <link rel="apple-touch-icon" sizes="76x76" href="https://ahlanantalya.com.tr/payment/logo.png">
      <link rel="icon" type="image/png" href="https://ahlanantalya.com.tr/payment/logo.png">
      
    <style>
        .alert.alert-danger {
            float: right;
            width: 100%;
            background: #e91e63;
            color: #fff;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper" id="app">
    <?php
        $amount = $_GET['a'];
        $type = $_GET['t'];
        $currencyVal = "";
        if($type == 1){
            $currencyVal = "949";			//Currency code, 949 for TL, ISO_4217 standard
        }else{
            $currencyVal = "840";			//Currency code, 949 for TL, ISO_4217 standard
        }
        $clientId = "700677004046";			//700677004046Merchant Id defined by bank to user
        $oid = "";							//Order Id. Must be unique. If left blank, system will generate a unique one.
        $okUrl = "https://ahlanantalya.com.tr/payment/pay.php";		//URL which client be redirected if authentication is successful
        $failUrl = "https://ahlanantalya.com.tr/payment/pay.php";	//URL which client be redirected if authentication is not successful
        $rnd = microtime();				//A random number, such as date/time
        $storekey = "Ahlan2006";			//Ahlan2006Store key value, defined by bank.
        $storetype = "3D";			//3D authentication model
        $lang = "en";					//Language parameter, "tr" for Turkish (default), "en" for English 
        $instalment = "";				//Instalment count, if there's no instalment should left blank
        $transactionType = "Auth";		//transaction type	
        $hashstr = $clientId . $oid . $amount . $okUrl . $failUrl .$transactionType. $instalment .$rnd . $storekey;
        $hash = base64_encode(pack('H*',sha1($hashstr)));
    ?>
    <div class="card-form">
      <div class="card-list">
        <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
          <div class="card-item__side -front">
            <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
            <div class="card-item__cover">
              <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
            </div>
            
            <div class="card-item__wrapper">
              <div class="card-item__top">
                <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip">
                <div class="card-item__type">
                  <transition name="slide-fade-up">
                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg">
                  </transition>
                </div>
              </div>
              <label for="cardNumber" class="card-item__number" ref="cardNumber">
                <template v-if="getCardType === 'amex'">
                 <span v-for="(n, $index) in amexCardMask" :key="$index">
                  <transition name="slide-fade-up">
                    <div
                      class="card-item__numberItem"
                      v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''"
                    >*</div>
                    <div class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      :key="$index" v-else-if="cardNumber.length > $index">
                      {{cardNumber[$index]}}
                    </div>
                    <div
                      class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      v-else
                      :key="$index + 1"
                    >{{n}}</div>
                  </transition>
                </span>
                </template>

                <template v-else>
                  <span v-for="(n, $index) in otherCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div
                        class="card-item__numberItem"
                        v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''"
                      >*</div>
                      <div class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        :key="$index" v-else-if="cardNumber.length > $index">
                        {{cardNumber[$index]}}
                      </div>
                      <div
                        class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        v-else
                        :key="$index + 1"
                      >{{n}}</div>
                    </transition>
                  </span>
                </template>
              </label>
              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__holder">Card Holder</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1">
                      <transition-group name="slide-fade-right">
                        <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                      </transition-group>
                    </div>
                    <div class="card-item__name" v-else key="2">Full Name</div>
                  </transition>
                </label>
                <div class="card-item__date" ref="cardDate">
                  <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                  <label for="cardMonth" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                      <span v-else key="2">MM</span>
                    </transition>
                  </label>
                  /
                  <label for="cardYear" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                      <span v-else key="2">YY</span>
                    </transition>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-item__side -back">
            <div class="card-item__cover">
              <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
            </div>
            <div class="card-item__band"></div>
            <div class="card-item__cvv">
                <div class="card-item__cvvTitle">CVV</div>
                <div class="card-item__cvvBand">
                  <span v-for="(n, $index) in cardCvv" :key="$index">
                    *
                  </span>

              </div>
                <div class="card-item__type">
                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg">
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-form__inner">
          
        <?php 
        	if($amount == null){
        	  echo '<div class="alert alert-danger">Sorry No Amount</div>';  
        	}
        ?>
        <form action="https://ahlanantalya.com.tr/payment/isBankasiPost.php" method="post">
        <div class="card-input">
          <label for="cardNumber" class="card-input__label">Card Number</label>
          <input type="text" id="cardNumber" required name="pan" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off">
        </div>
        <div class="card-input">
          <label for="cardName" class="card-input__label">Card Holder</label>
          <input type="text" id="cardName" required name="holder" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
        </div>
        <div class="card-form__row">
          <div class="card-form__col">
            <div class="card-form__group">
              <label for="cardMonth" class="card-input__label">Expiration Date</label>
              <select class="card-input__input -select"  name="Ecom_Payment_Card_ExpDate_Month"  id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value="" disabled selected>Month</option>
                <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">
                    {{n < 10 ? '0' + n : n}}
                </option>
              </select>
              <select class="card-input__input -select"  name="Ecom_Payment_Card_ExpDate_Year"  id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value="" disabled selected>Year</option>
                <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
                    {{$index + minCardYear}}
                </option>
              </select>
            </div>
          </div>
          <div class="card-form__col -cvv">
            <div class="card-input">
              <label for="cardCvv" name="cvv" required class="card-input__label">CVC</label>
              <input type="text" class="card-input__input" id="cardCvv" v-mask="'####'" name="cv2" maxlength="4" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off">
            </div>
          </div>
        </div>
        
        <div class="card-form__row">
          <div class="card-form__col">
            <div class="card-input">
              <label for="ams" class="card-input__label">Amount</label>
              <input type="text" required  class="card-input__input" readonly value="<?php echo $amount; ?>"  autocomplete="off">
            </div>
          </div>
          <div class="card-form__col">
            <div class="card-input">
              <label for="cur" class="card-input__label">Currancy</label>
               <select name="cur" id="cur" class="card-input__input" required disabled>
                   <option>NO Currancy</option>
                    <option value="840" <?php echo $currencyVal == 840 ? "selected" : "" ?>>USD</option>
                    <option value="949" <?php echo $currencyVal == 949 ? "selected" : "" ?>>TL</option>
                </select>
            </div>
          </div>
        </div>
        <div class="card-input" style="display: none;">
          <label for="cardType" class="card-input__label">Card Type</label>
            <select name="cardType" id="cardType" class="card-input__input" required>
                <option value="1">Visa</option>
                <option value="2">MasterCard</option>
            </select>
        </div>
        
        <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
        <input type="hidden" name="encoding" value="UTF-8">
        
        <input type="hidden" name="clientid" value="<?php echo $clientId; ?>" />
        
		<input type="hidden" name="islemtipi" value="<?php echo $transactionType; ?>" />
		<input type="hidden" name="taksit" value="<?php echo $instalment; ?>" />
        <input type="hidden" name="oid" value="<?php echo $oid; ?>" />
        <input type="hidden" name="okUrl" value="<?php echo $okUrl; ?>" />
        <input type="hidden" name="failUrl" value="<?php echo $failUrl; ?>" />
        <input type="hidden" name="rnd" value="<?php echo $rnd; ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
        <input type="hidden" name="storetype" value="<?php echo $storetype; ?>" />
        <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
        <input type="hidden" name="currency" value="<?php echo $currencyVal; ?>" />
        
		<?php 
    		$show = true;
    		if($amount != null){
    		    echo '<button class="card-form__button">Pay</button>';
    		}
		?>
        
        </form>
      </div>
    </div>
  </div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
    <script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script><script  src="./script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
    <script>
        $( document ).ready(function() {
            $(document).on('change', '#cardNumber', function() {
                var val = $(this).val();
                val = val.replace(/\s+/g, '');
                var type = getCardType(val);
                var type_id = 1;
                if(type == "mastercard"){
                    type_id = 2;
                }
                $("#cardType").val(val);
            });
        });
        function getCardType (number) {
          const re = {
            electron: /^(4026|417500|4405|4508|4844|4913|4917)\d+$/,
            maestro: /^(5018|5020|5038|5612|5893|6304|6759|6761|6762|6763|0604|6390)\d+$/,
            dankort: /^(5019)\d+$/,
            interAHLAN ANTALYA: /^(636)\d+$/,
            unionpay: /^(62|88)\d+$/,
            visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
            mastercard: /^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/,
            amex: /^3[47][0-9]{13}$/,
            diners: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
            discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
            jcb: /^(?:2131|1800|35\d{3})\d{11}$/
          }
        
          for (var key in re) {
            if (re[key].test(number)) {
              return key
            }
          }
          
          return 'unknown'
        }
    </script>
</body>
</html>
