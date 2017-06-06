<?php
	include 'PHPExcel/PHPExcel.php';

	class fill_template {
		var $startrow = 0;
		function __construct($fn) {
			date_default_timezone_set('Asia/Shanghai');
			$this->tpl = PHPExcel_IOFactory::load($fn);
			$this->target = clone $this->tpl;
		}
		function add_data($ar) {
			$sheet = $this->tpl->getActiveSheet();
			//获取最大行
			$maxRows    = $sheet->getHighestRow();
			//获取最大列
			$maxColumns = $sheet->getHighestColumn();
			//获取最大列的数字形式
			$maxColumns = PHPExcel_Cell::columnIndexFromString($maxColumns);
			//行循环
			for($iR = 2; $iR <= $maxRows; $iR++){
				//列循环
				for($iC = 0; $iC < $maxColumns; $iC++){
					$txt = $sheet->getCellByColumnAndRow($iC, $iR)->getValue();
					if(preg_match('/{(.+)}/',$txt ,$match)){
						//获取ar的值
						$vo=$ar[$match[1]];
						 $this->target->getActiveSheet()->getCellByColumnAndRow($iC, $iR)->setValue($vo);
					}
				}
			}
		}
		function output($fn) {
			$t = PHPExcel_IOFactory::createWriter($this->target, 'Excel5');
			$t->save($fn);
		}
	}

	$p = new fill_template('test.xls');
	$p->add_data(array('name'=>'cpj','age'=>'qw3'));
	$p->output('xxx.xls');
