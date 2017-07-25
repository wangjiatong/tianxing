<?php
	require_once('api.php');

	header("Content-type:text/html;charset=utf-8");

	$auth = new Api();//实例化Api类

	$get = $_GET;
	$api = $get['api'];

	$data['account'] = $auth->authInfo['data']['account'];
	$data['accessToken'] = $auth->authInfo['data']['accessToken'];
	$i = 0;
	foreach ($get as $key => $value) 
	{
		if($i == 0)
		{
			$i++;
			continue;
		}
	 	$data[$key] = $value;
	 	$i++;
	 } 
	 var_dump($data);
	 $res = $auth->getApiRes($api, $data);
	 var_dump($res);
	 // $res_data = $res['data'];
	 // var_dump($res_data);

	 // 返回按钮
	 echo "<br /><a href='search.html'>返回</a><br />";

	 switch ($api) {
	 	case 'clxq':
	 		if($res['success'] === true)
	 		{
		 		showRes('clxq', $res['data']);
	 		}else{
	 			echo '无查询结果';
	 		}
	 		break;
 		case 'fmxx':
	 		if($res['success'] === true && $res['data']['status'] === 'EXSIT')
	 		{
	 			showRes('fmxx', $res['data']);
	 		}elseif($res['success'] === true && $res['data']['status'] === 'NO_DATA'){
	 			echo '无查询结果';
	 		}else{
	 			echo '异常响应数据';
	 		}
	 		break;
 		case 'grss':
 			if($res['success'] === true)
 			{
 				unset($data['dataType']);
 				unset($data['idCard']);
 				$data['dataType'] = 'fygg';
 				// var_dump($data);
 				$fygg = $auth->getApiRes('grss', $data);
 				// var_dump($fygg);
 				$res['data']['fygg'] = $fygg;
 				// $res_data = array_merge($res['data'], $fygg);
 				// var_dump($res['data']);
 				showRes('grss', $res['data']);
 			}else{
 				echo '异常响应数据';
 			}
 			break;
		case 'qygssj':
			if($res['status'] === 'EXIST')
			{
				showRes('qygssj', $res);
			}else{
				echo '无查询结果';
			}
			break;
		case 'qyss':
			if($res['success'] === true && $res['data']['checkStatus'] === 'NO_DATA')
			{
				echo '查无数据';
			}elseif($res['success'] === false){
				echo '异常响应数据';
			}else{
 				unset($data['dataType']);
 				$data['dataType'] = 'fygg';
 				$fygg = $auth->getApiRes('qyss', $data);
 				$res_data = array_merge($res['data'], $fygg['data']);
 				showRes('qyss', $res_data);				
			}
		case 'sjhzwsc':
			if($res['success'] === true)
			{
				showRes('sjhzwsc', $res['data']);
			}else{
				echo '查无数据';
			}
			break;
		case 'sjhzt':
			if($res['success'] === true)
			{
				showRes('sjhzt', $res['data']);
			}else{
				echo '查无数据';
			}
			break;
		case 'ylsys':
			if($res['success'] === true)
			{
				showRes('ylsys', $res['data']);
			}else{
				echo '查无数据';
			}
			break;
		case 'yyssys':
			if($res['success'] === true)
			{
				showRes('yyssys', $res['data']);
			}else{
				echo '查无数据';
			}
			break;
		case 'dcjd':
			if($res['success'] === true)
			{
				showRes('dcjd', $res['data']);
			}else{
				echo '查无数据';
			}
			break;
		case 'grmxqy':
			if($res['success'] === true)
			{
				showRes('grmxqy', $res['data']);
			}else{
				echo '查无数据';
			}
			break;
		case 'grxyyz':
			if($res['success'] === true && $res['data']['status'] === 'NO_DATA')
			{
				echo '查无数据';
			}elseif($res['success'] === false){
				echo '异常响应数据';
			}else{
				showRes('grxyyz', $res['data']);
			}
			break;
		case 'ylshposbg':
			if($data['success'] === false)
			{
				echo '异常相应数据';
			}else{
				showRes('ylshposbg', $res);
			}
	 		break;
	 	default:
	 		# code...
	 		break;
	 }

	 //处理接口返回结果
	 function showRes($api, $res_data)
	 {
 		$tag = Api::attributeName($api);
 		foreach ($res_data as $key => $value) 
 		{
 			if(is_array($res_data[$key]))
 			{
 				echo "[分类]" . $key;
 				foreach($res_data[$key] as $k => $v)
 				{
 					echo $tag[$key][$k] . ": " . $v . "<br />";
 				}
 			}
 			echo $tag[$key] . ": " . $value . "<br />";
 		}	 	
	 }


?>

