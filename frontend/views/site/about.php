<style>
    table {
	background: #f5f5f5;
	box-shadow: inset 0 1px 0 #fff;
	font-size: 12px;
	line-height: 24px;
	margin: 30px auto;
	text-align: left;
	width: 800px;
}	

th {
	background: #000000;
	box-shadow: inset 0 1px 0 #999;
	color: #fff;
  font-weight: bold;
	padding: 10px 15px;
	position: relative;
	text-shadow: 0 1px 0 #000;	
}

th:after {
	background: linear-gradient(rgba(255,255,255,0), rgba(255,255,255,.08));
	content: '';
	display: block;
	height: 25%;
	left: 0;
	margin: 1px 0 0 0;
	position: absolute;
	top: 25%;
	width: 100%;
}

th:first-child {
	border-left: 1px solid #777;	
	box-shadow: inset 1px 1px 0 #999;
}

th:last-child {
	box-shadow: inset -1px 1px 0 #999;
}

td {
	border-right: 1px solid #fff;
	border-left: 1px solid #e8e8e8;
	border-top: 1px solid #fff;
	border-bottom: 1px solid #e8e8e8;
	padding: 10px 15px;
	position: relative;
	transition: all 300ms;
}

td:first-child {
	box-shadow: inset 1px 0 0 #fff;
}	

td:last-child {
	border-right: 1px solid #e8e8e8;
	box-shadow: inset -1px 0 0 #fff;
}	

tr {
	background: url(https://jackrugile.com/images/misc/noise-diagonal.png);	
}

tr:nth-child(odd) td {
	background: #f1f1f1 url(https://jackrugile.com/images/misc/noise-diagonal.png);	
}

tr:last-of-type td {
	box-shadow: inset 0 -1px 0 #fff; 
}

tr:last-of-type td:first-child {
	box-shadow: inset 1px -1px 0 #fff;
}	

tr:last-of-type td:last-child {
	box-shadow: inset -1px -1px 0 #fff;
}	

tbody:hover td {
	color: transparent;
	text-shadow: 0 0 3px #aaa;
}

tbody:hover tr:hover td {
	color: #444;
	text-shadow: 0 1px 0 #fff;
}
</style>
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\db\Query;
$this->title = 'Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

<table align="center" width="50%" border="1">
	<tr>
		<th>Nomor Order</th>
		<th>Nama Customer</th>
		<th>Daftar Item</th>
	</tr>
	<?php
		$query = new Query();
		$id = $query->select(['customer_id','id_order'])
					->from('order')
					->all();

		foreach ($id as $key => $value) {
			$nama=$query->select(['nama'])
			->from('customer')
			->where(['id_customer'=>''.$value['customer_id'].''])
			->all();
			echo'<tr>';

				foreach ($nama as $key => $val) {
					echo '<td align="center">'.$value['id_order'].'</td>';
					echo '<td>'.$val['nama'].'</td>';
					echo '<td>';
				}
				$orderId = $query->select(['item_id'])->from('order_item')
								 ->where(['order_id'=>''.$value['id_order'].''])
								 ->all();

					foreach ($orderId as $key => $value) {
						$namaItem = $query->select(['name'])
									->from('item')
									->where(['id'=>''.$value['item_id'].''])
									->all();
									
						foreach ($namaItem as $key => $value) {
							echo "".$value['name']."";
						}
					}
				echo '</td>';
			echo'</tr>';
				
		}

	?>

</table>

</div>
