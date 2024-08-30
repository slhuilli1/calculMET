<?php
	defined('_JEXEC') or die('Access deny');
	
	class plgContentcalculMet extends JPlugin 
	{
		function onContentPrepare($content, $article, $params, $limit){	
			$document = JFactory::getDocument();
			$document->addStyleSheet(JURI::base().'plugins/content/calculmet/style.css');			
			
			$re = '/{calcul_MET}(.*){\/calcul_MET}/mi';
			preg_match_all($re, $article->text, $matches, PREG_SET_ORDER, 0);
			$ch = explode(',',$matches[0][1]);
			$r1 = (intval($ch[0]) * 4 * intval($ch[1]))/200;
			$r2 = (intval($ch[0]) * 5.3 * intval($ch[1]))/200;
			$rmoyenne = ($r1+$r2)/2;
			$re = '/{calcul_MET}.*{\/calcul_MET}/mi';
			
			$ch  = '<div class="calcul-MET">';
			$ch .= '<div><span class="libelle libelle-min">Valeur minimale</span><span class="libelle valeur-min">'.$r1.'</span></div>
			<div><span class="libelle libelle-moyenne">Valeur moyenne</span><span class="libelle valeur-moyenne">'.$rmoyenne.'</span></div>
			<div><span class="libelle libelle-max">Valeur maximale</span><span class="libelle valeur-max">'.$r2.'</span></div>';
			
			$article->text =  preg_replace($re, $ch, $article->text);
			
			
		}	
	}
?>