<?php
$services = $this->context->services;
$pagesonmain = $this->context->pagesonmain;

?>


<footer>
    <div class="callback-cont df jc-fs">
        <div class="callback-text-cont">
            <div class="callback-title">Нужна консультация?</div>
            <div class="callback-text">Заполните форму и наш специалист проконсультирует вас</div>
        </div>
        <div class="form-g">
            <input type="text" placeholder="Как к вам обращаться?" id="callback-name">
            <div class="help-b"></div>
        </div>
        <div class="form-g">
            <input type="text" placeholder="Контактный телефон" id="callback-phone">
            <div class="help-b"></div>
        </div>

        <div class="button btn-red callback-button" id="callback-button">Отправить</div>
    </div>
    <div class="footer-cont df">
        <div class="footer-same-cont df ai-fs">
			<div class="footer-col footer-col-3">
                <div class="title footer_sl_tooggle">Каталог оборудования</div>
				<div class="footer_sl">
                <ul>
                    <li><a href="/catalog/promyslennaa-mebel">Промышленная мебель</a></li>
                    <li><a href="/catalog/antistaticeskaa-mebel-i-osnasenie">Антистатическая мебель и оснащение</a></li>
                    <li><a href="/catalog/paalnoe-oborudovanie">Паяльное оборудование</a></li>
                    <li><a href="/catalog/izmeritelnye-pribory">Измерительные приборы</a></li>                   
					<li><a href="/manufacturers">Производители</a></li>
                </ul>
				</div>
            </div>	
		
            <div class="footer-col footer-col-1">                
			<div class="title footer_sl_tooggle">Услуги</div>    
			<div class="footer_sl">            
			<ul>                    
			        <?php foreach ($services as $service) { ?>
                        <li class=""><a href="<?= $service->href ?>"><?= $service->name ?></a></li>
                    <?php } ?>                
			</ul>    
			</div>
			</div>            
			
			<div class="footer-col footer-col-2">                
			<div class="title footer_sl_tooggle">Компания</div>  
			<div class="footer_sl"> 
			<ul>                    
			
			                        <li class=""><a href="/news">Новости</a></li>

			        <?php foreach ($pagesonmain as $pom) { ?>
                        <li class=""><a href="/<?= $pom->slug ?>"><?= $pom->name ?></a></li>
                    <?php } ?>                
			</ul>            
			</div>
			</div>
            
		            
			<div class="footer-col footer-col-4">    
			<div class="title footer_sl_tooggle">Наши контакты в <?= $this->context->city->name_pad_1 ?></div>    
			<div class="footer_sl"> 			
			<div class="footer-info"><img src="/img/phone.svg" alt=""><a href="tel:<?= $this->context->phone ?>"><?= $this->context->phone ?></a></div>      
			<div class="footer-info"><img src="/img/email.svg" alt=""> <a href="mailto:<?= $this->context->email ?>" style="text-decoration: underline;"><?= $this->context->email ?></a></div>
			<div class="footer-info"><img src="/img/marker.svg" alt=""> <?= $this->context->city->address ?></div> 	
			<div class="footer-info"><img src="/img/clock.svg" alt=""> Понедельник-Пятница с 9:00 до 18:00</div>                
			</div>
			</div>
			
			<div class="footer-col footer-col-2 footer-col-soc">     
			<div class="socset">	
			<div class="title">Присоединяйся к нам</div>                
			<div class="socseti">
			<a href="https://www.youtube.com/channel/UChTI1PnAO0KQn3d6i5iXTLA" target="_blank"><img src="/img/soc1.png" style="margin-bottom: 15px;"></a>

			</div> 
			</div> 
			<div class="socset">
			<div class="title">К оплате принимаем</div>    
			<div class="socseti"><a href="/sposoby-oplaty"><img src="/img/cards.png"></a></div> 
			</div>
			</div>
        </div>                
		<div class="copyright">(c) 2013-<?= date('Y', time()) ?> "Промышленная мебель"</div>

    </div>
</footer>