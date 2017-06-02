<?php

class   foo
{

	//excel导出
	public function exportExcel($expTitle, $expCellName, $expTableData)
	{
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
		$fileName = $_SESSION['account'] . date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
		$cellNum = count($expCellName);
		$dataNum = count($expTableData);

		/*如果是thinkcmf通过此方法引入第三方库*/
		vendor("PHPExcel.PHPExcel");


		$objPHPExcel = new \PHPExcel();
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[ $cellNum - 1 ] . '1');//合并单元格
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
		for($i = 0; $i < $cellNum; $i++){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[ $i ] . '2', $expCellName[ $i ][1]);
		}
		// Miscellaneous glyphs, UTF-8
		for($i = 0; $i < $dataNum; $i++){
			for($j = 0; $j < $cellNum; $j++){
				$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[ $j ] . ($i + 3), $expTableData[ $i ][ $expCellName[ $j ][0] ]);
			}
		}
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=;name="' . $xlsTitle . '.txt"');
		header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}

	/**
	 * 导出Excel
	 */
	public function expUser()
	{//导出Excel
		$xlsName = "User";
		//excel标签
		$xlsCell  = array(
			array('id','账号序列'),
			array('name','名字'),
			array('plate','车牌'),
			array('amount','保费'),
			array('createtime','创建时间'),

		);
		$xlsModel = M('Order');
		$xlsData = $xlsModel->Field('id,name,plate,amount,createtime')->select();
		/*判断男女值*/
		foreach($xlsData as $k => $v){
			$xlsData[ $k ]['sex'] = $v['sex'] == 1 ? '男' : '女';
		}
		$this->exportExcel($xlsName, $xlsCell, $xlsData);

	}

}