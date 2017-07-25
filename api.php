<?php
class Api
{
	public $getAuthUrl = 'http://tianxingshuke.com/api/rest/common/organization/auth';//获取授权码地址
	public $authArr = ['account' => 'jjzl', 'signature' => 'c74ed5499f734c1ea4aa9706629a7be4'];//账号及签名
	public $authInfo;//授权码

	//Api类的构造函数,用于获取授权码
	function __construct()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getAuthUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->authArr);//POST方式请求获取授权码的api
		$res = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($res, true);//加上true将json对象转化为数组
		$this->authInfo = $res;//将获取到的授权码添加到对象属性
	}

	//用户获取api结果
	public function getApiRes($api, $data = [])
	{
		//获取api地址
		$url = $this->getApiUrl($api);
		//拼接GET方式的api地址
		foreach ($data as $key => $value) {
			$url .= $key . '=' . $value . '&';
		}
		//去掉地址末尾多余的字符串&
		$url = substr($url, 0, strlen($url) - 1);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$res = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($res, true);
		return $res;
	}

	//根据api返回对应的api地址
	public function getApiUrl($api)
	{
		switch ($api) 
		{
			case 'clxq':
				return 'http://tianxingshuke.com/api/rest/traffic/vehicle?';//车辆详情
				break;
			case 'fmxx':
				return 'http://tianxingshuke.com/api/rest/police/negative?';//负面信息
				break;
			case 'grss':
				return 'http://tianxingshuke.com/api/rest/law/highcourt/personal?';//个人涉诉
				break;
			case 'qygssj':
				return 'http://tianxingshuke.com/api/rest/enterprise/credit?';//企业工商数据
				break;
			case 'qyss':
				return 'http://tianxingshuke.com/api/rest/law/highcourt/enterprise?';//企业涉诉
				break;
			case 'sjhzwsc':
				return 'http://tianxingshuke.com/api/rest/operators/mobile/onlinetime?';//手机号在网时长
				break;
			case 'sjhzt':
				return 'http://tianxingshuke.com/api/rest/operators/mobile/status?';//手机号状态查询
				break;
			case 'ylsys':
				return 'http://tianxingshuke.com/api/rest/unionpay/auth/4element?';//银联四要素
				break;
			case 'yyssys':
				return 'http://tianxingshuke.com/api/rest/operators/auth/3element?';//运营商三要素
				break;		
			case 'dcjd':
				return 'http://search.tianxingshuke.com/api/rest/riskTip/lending/multipleV2';//多重借贷
				break;
			case 'grmxqy':
				return 'http://tianxingshuke.com/api/rest/enterprise/member';//个人名下企业
				break;
			case 'grxyyz':
				return 'http://tianxingshuke.com/api/rest/riskTip/blackInfo';//个人信用验证
				break;
			case 'ylshposbg':
				return 'http://tianxingshuke.com/api/rest/unionpay/report/businessV2 ';//银联商户pos报告查询
				break;
			default:
				# code...
				break;
		}
	}

	//输出数据表格
	// public function echoTable($data = [])
	// {
	// 	echo "<table>";
	// 	foreach ($data as $key => $value) 
	// 	{
	// 		echo "<tr><td>$key</td><td>$value</td></tr>";
	// 	}
	// 	echo "</table>";
	// }

	//返回数据英中键值对数组
	public static function attributeName($api)
	{
		switch ($api) {
			case 'clxq':
				return $clxq = [
					'factory' => '厂家',
					'brands' => '品牌',
					'carSeries' => '车系',
					'vehicleModel' => '车型',
					'marketName' => '销售名称',
					'yearModel' => '年款',
					'emissionStandards' => '排放标准',
					'vehicleType' => '车辆类型',
					'vehicleLevel' => '车辆级别',
					'guidancePrice' => '指导价格',
					'listingYear' => '上市年份',
					'emissions' => '汽车排量',
					'gearboxType' => '变速箱类型',
					'vinYear' => 'VIN对应的年份',
					'code' => '编号',
					'engineType' => '发动机型号',
					'transmissionType' => '变速器类型',
					'numberGear' => '档位数',
					'vehicleModelNum' => '车型代码',
					'productionHaltsYear' => '停产年份',
					'listingMonth' => '上市月份',
					'productiveYear' => '生产年份',
					'carBodyType' => '车身形式',
					'doorNumber' => '车门数',
					'seating' => '座位数',
					'maximumPower' => '发动机最大功率',
					'fuelType' => '燃油类型',
					'fuelNum' => '燃油编号',
					'driveMode' => '驱动方式',
					'numberEngineCylinder' => '发动机缸数',
					'status' => '有无返回数据',
				];
				break;
			case 'fmxx':
				return $fmxx = [
					'name' => '姓名',
					'idCard' => '身份证号',
					'comparisonResult' => '对比结果',
					'caseTime' => '案发时间',
					'status' => '查询数据状态',
				];
				break;
			case 'grss':
				return $grss = [
					'fygg' => [
						'announcementType' => '公告类型',
						'content' => '公告内容',
						'recordTime' => '发布时间',
						'name' => '当事人',
						'court' => '法院名称',
					],
					'cpws' => [
						'caseNo' => '裁判文的案件号',
						'caseType' => '案件类型',
						'recordTime' => '立案时间',
						'content' => '内容',
						'title' => '标题',
						'desc' => '简述',
					],
					'zxgg' => [
						'caseNO' => '案号',
						'identificationNO' => '身份证号',
						'executionTarget' => '立案时间',
						'name' => '被执行人',
						'court' => '法院名称',
					],
					'sxgg' => [
						'gender' => '性别',
						'implementationStatus' => '履行情况',
						'exeCid' => '执行依据文号',
						'name' => '被执行人姓名',
						'identificationNO' => '身份证号',
						'executableUnit' => '做出执行依据单位',
						'specificCircumstances' => '失信被执行人行为具体情形',
						'age' => '年龄',
						'postTime' => '发布时间',
						'caseNO' => '案号',
						'recordTime' => '立案时间',
						'court' => '执行法院名称',
						'type' => '标识自然人或企业',
						'province' => '省份',
					],
				];
				break; 
			case 'qygssj':
				return $qygssj = [
					'basic' => [
						'entName' => '企业名称',
						'regNo' => '注册号',
						'oRigegNo' => '原注册号',
						'fName' => '法定代表人姓名',
						'regCap' => '注册资本（万元）',
						'recCap' => '实收资本（万元）',
						'regCapCur' => '注册资本币种',
						'entStatus' => '经营状态',
						'entType' => '企业（机构）类型',
						'esDate' => '开业日期',
						'opForm' => '经营期限自',
						'opTo' => '经营期限至',
						'dom' => '住址',
						'regorg' => '登记机关',
						'abuItem' => '许可经营项目',
						'cbuItem' => '一般经营项目',
						'opScope' => '经营（业务）范围',
						'opScoandForm' => '经营（业务）范围及方式',
						'anCheYear' => '最后年检年度',
						'changDate' => '变更日期',
						'canDate' => '注销日期',
						'revDate' => '吊销日期',
						'anCheDate' => '最后年检日期',
						'induStryphyCode' => '行业门类代码',
						'induStryphyName' => '行业门类名称',
						'induStryCoCode' => '国民经济行业代码',
						'induStryCoName' => '国民经济行业名称',
					],
					'shareholder' => [
						'shaName' => '股东名称',
						'subConAm' => '认缴出资额（万元）',
						'regCapCur' => '认缴出资币种',
						'conForm' => '出资方式',
						'fundedRatio' => '出资比例',
						'conDate' => '出资日期',
						'country' => '国别',
						'invaMount' => '股东总数量',
						'invSumFundedRatio' => '股东出资比例总和',
					],
					'shareholderPersons' => [
						'name' => '姓名',
						'position' => '职位',
						'sex' => '性别',
						'personAmount' => '总人数',
					],
					'legalPersonInvests' => [
						'name' => '姓名',
						'entName' => '企业（机构）名称',
						'regNo' => '注册号',
						'entType' => '企业（机构）类型',
						'regCap' => '注册资本（万元）',
						'regCapCur' => '注册资本币种',
						'entStatus' => '经营状态',
						'canDate' => '注销日期',
						'revDate' => '吊销日期',
						'regOrg' => '登记机关',
						'subConAm' => '认缴出资额（万元）',
						'curRenCy' => '认缴出资币种',
						'conForm' => '出资方式',
						'fundedRatio' => '出资比例',
						'esDate' => '开业日期',
					],
					'legalPersonPositions' => [
						'name' => '姓名',
						'entName' => '企业（机构）名称',
						'regNo' => '注册号',
						'entType' => '企业（机构）类型',
						'regCap' => '注册资本（万元）',
						'regCapCur' => '注册资本币种',
						'entStatus' => '经营状态',
						'canDate' => '注销日期',
						'revDate' => '吊销日期',
						'regOrg' => '登记机关',
						'position' => '职务',
						'lerepSign' => '是否法定代表人',
						'esDate' => '开业日期',
						'entAmount' => '企业总数量',
					],
					'enterpriseInvests' => [
						'entName' => '企业（机构）名称',
						'regNo' => '注册号',
						'entType' => '企业（机构）类型',
						'regCap' => '注册资本（万元）',
						'regCapCur' => '注册资本币种',
						'entStatus' => '经营状态',
						'canDate' => '注销日期',
						'revDate' => '吊销日期',
						'regOrg' => '登记机关',
						'subConAm' => '认缴出资额（万元）',
						'conGroCur' => '认缴出资币种',
						'conFrom' => '出资方式',
						'fundedRation' => '出资比例',
						'binvvAmout' => '企业总数量',
						'name' => '法定代表人姓名',
						'openingDate' => '开业时间',
					],
					'alterInfos' => [
						'altDate' => '变更日期',
						'altItem' => '变跟事项',
						'altBe' => '变更前内容',
						'altAf' => '变更后内容',
					],
					'filiations' => [
						'brName' => '分支机构名称',
						'brRegNo' => '分期机构企业注册号',
						'brPrincipal' => '分支机构负责人',
						'cbuItme' => '一般经营项目',
						'brAddr' => '分支机构地址',
					],
					'shareSimpaWns' => [
						'impOrg' => '质权人姓名',
						'impOrgType' => '出质人类别',
						'impAm' => '出质金额（万元）',
						'impOnRecDate' => '出质备案日期',
						'impExaeEp' => '出质审批部门',
						'impSanDate' => '出质批准日期',
						'impTo' => '出质截至日期',
					],
					'morDetails' => [
						'morRegId' => '抵押ID',
						'mortgagor' => '抵押人',
						'more' => '抵押权人',
						'regOrg' => '登记机关',
						'regiDate' => '登记日期',
						'morType' => '状态标识',
						'morRegcNo' => '登记证号',
						'appRegrea' => '申请抵押原因',
						'priClaseKind' => '被担保主权债种类',
						'priClaseCam' => '被担保主权债数额（万元）',
						'pefperFrom' => '履约起始日期',
						'pefperTo' => '履约截止日期',
						'canDate' => '注销日期',
					],
					'morguaInfos' => [
						'morRegId' => '抵押ID',
						'guaName' => '抵押物名称',
						'quan' => '数量',
						'value' => '价值（万元）',
						'caseCode' => '案号',
						'name' => '被执行人姓名/名称',
						'type' => '失信人类型',
						'sex' => '性别',
						'age' => '年龄',
						'cardNum' => '身份证号码',
						'ysfzd' => '身份证原始发证地',
						'businessEntity' => '法定代表人/负责人姓名',
						'regDate' => '立案时间',
						'publishDate' => '发布时间',
						'courName' => '执行法院',
						'areaName' => '省份',
						'gistId' => '执行依据文号',
						'gistUnit' => '执行依据单位',
						'duty' => '法律文书确定的义务',
						'disruptTypeName' => '失信被执行人行为具体情形',
						'performAnce' => '被执行人的履行情况',
						'performedPart' => '已履行',
						'unPerformPart' => '未履行',
					],
					'punished' => [
						'caseCode' => '案号',
						'name' => '被执行人姓名/名称',
						'cardNum' => '身份证号码',
						'sex' => '性别',
						'age' => '年龄',
						'areaName' => '省份',
						'ysfzd' => '身份证原始发证地',
						'courtName' => '执行法院',
						'regDate' => '立案时间',
						'caseState' => '案件状态',
						'execMoney' => '执行标的（元）',
					],
					'sharesFrosts' => [
						'froDocNo' => '冻结文号',
						'froAuth' => '冻结机关',
						'froFrom' => '冻结起始日期',
						'froTo' => '冻结截至日期',
						'froAm' => '冻结金额（万元）',
						'thawAuth' => '解冻机关',
						'thawDocNo' => '解冻文号',
						'thawDate' => '解冻日期',
						'thawComment' => '解冻说明',
					],
					'liquidations' => [
						'ligEntity' => '清算责任人',
						'ligPrincipal' => '清算负责人',
						'liQMen' => '清算组成员',
						'liGSt' => '清算完结情况',
						'ligEndDate' => '清算完结日期',
						'debtTranee' => '债务承接人',
						'claimTranee' => '债权承接人',
					],
					'caseInfos' => [
						'caseTime' => '案发时间',
						'caseReason' => '案由',
						'caseVal' => '案值',
						'caseType' => '违法行为类型',
						'exeSort' => '执行类别',
						'caseResult' => '案件结果',
						'penDecNo' => '处罚决定文书',
						'penDeclssDate' => '处罚决定书签发日期',
						'penAuth' => '作出行政处罚决定机关名称',
						'illegFact' => '主要违法事实',
						'penBasis' => '处罚依据',
						'penType' => '处罚种类',
						'penResult' => '处罚结果',
						'penAm' => '处罚金额',
						'penExeSt' => '处罚执行情况',
					],
				];
				break;
			case 'qyss':
				return $qyss = [
					'cpws' => [
						'caseNo' => '裁判文书的案件号',
						'caseType' => '案件类型',
						'recordTime' => '立案时间',
						'content' => '内容',
						'title' => '标题',
						'desc' => '简述',
					],
					'zxgg' => [
						'caseNo' => '案号',
						'identificationNO' => '组织机构代码',
						'exexcutionTarget' => '执行标的',
						'recordTime' => '立案时间',
						'name' => '企业名称',
						'court' => '法院名称',
					],
					'sxgg' => [
						'gender' => '性别',
						'implementationStatus' => '履行情况',
						'exeCid' => '执行依据文号',
						'name' => '企业名称',
						'identificationNO' => '组织机构代码',
						'executableUnit' => '作出执行依据单位',
						'specificCircumstances' => '失信被执行人行为具体情形',
						'age' => '年龄',
						'postTime' => '发布时间',
						'caseNO' => '案号',
						'recordTime' => '立案时间',
						'court' => '执行法院名称',
						'type' => '标识自然人或企业',
						'province' => '省份',
					],
					'fygg' => [
						'announcementType' => '公告类型',
						'content' => '公告内容',
						'recordTime' => '发布时间',
						'name' => '当事人',
						'court' => '法院名称',
					],
				];
				break;
			case 'sjhzwsc':
				return $sjhzwsc = [
					'success' => '结果状态',
					'mobile' => '查询号码',
					'onlineTime' => '在网时长',
					'resultStatus' => '查询状态',
					'resultStatusDesc' => '查询状态描述',
				];
				break;
			case 'sjhzt':
				return $sjhzt = [
					'mobileState' => '手机号状态',
					'mobile' => '手机号',
					'resultStatus' => '结果状态',
					'resultStatusDesc' => '结果状态描述',
				];
				break;
			case 'ylsys':
				return $ylsys = [
					'name' => '姓名',
					'identityCard' => '身份证号',
					'accountNo' => '银行卡号',
					'bankPreMobile' => '预留手机号',
					'checkStatus' => '返回码',
					'result' => '验证结果',
				];
				break;
			case 'yyssys':
				return $yyssys = [
					'name' => '姓名',
					'identityCard' => '身份证号',
					'mobile' => '手机号',
					'compareStatus' => '状态码',
					'compareStatusDesc' => '状态码描述',
				];
				break;
			case 'dcjd':
				return $dcjd = [
					'phone' => '电话',
					'province' => '省份',
					'city' => '城市',
					'cycle' => '查询周期',
					'creditPlatformRegistrationDetails' => '信贷平台注册详情',
					'loanApplicationDetails' => '贷款申请详情',
					'loanDetails' => '贷款放贷情况',
					'loanRejectDetails' => '贷款驳回详情',
					'overduePlatformDetails' => '逾期平台详情查询',
					'arrearsInquiry' => '欠款查询',
					'status' => '返回状态',
					'statusDesc' => '返回状态描述',
				];
				break;
				case 'grmxqy':
					return $grmxqy = [
						'caseInfos' => [
							'caseTime' => '案发时间',
							'caseReason' => '案由',
							'caseVal' => '案值',
							'caseType' => '案件类型',
							'exeSort' => '执行类别',
							'caseResult' => '案件结果',
							'penDecNo' => '处罚决定文书',
							'penDeclssDate' => '处罚决定书签发日期',
							'penAuth' => '做出行政处罚决定机关名',
							'illegFact' => '主要违法事实',
							'penBasis' => '处罚依据',
							'penType' => '处罚种类',
							'penResult' => '处罚结果',
							'penAm' => '处罚金额',
							'penExeSt' => '处罚执行情况',
							'cardNO' => '证件号',
							'name' => '当事人',
						],
						'corporates' => [
							'ryName' => '查询人姓名',
							'entName' => '企业（机构）名称',
							'regNo' => '注册号',
							'entType' => '企业（机构）类型',
							'regCap' => '注册资本（万元）',
							'regCapCur' => '注册资本币种',
							'entStatus' => '企业状态',
						],
						'corporateShareholders' => [
							'ryName' => '查询人姓名',
							'entName' => '企业（机构）名称',
							'regNo' => '注册号',
							'entType' => '企业（机构）类型',
							'regCap' => '注册资本（万元）',
							'regCapCur' => '注册资本币种',
							'entStatus' => '企业状态',
							'subConam' => '认缴出资额（万元）',
							'currency' => '认缴出资币种',
							'fundedRatio' => '出资比例',
						],
						'corporateManagers' => [
							'ryName' => '查询人姓名',
							'entName' => '企业（机构）名称',
							'regNo' => '注册号',
							'entType' => '企业（机构）类型',
							'regCap' => '注册资本（万元）',
							'regCapCur' => '注册资本币种',
							'entStatus' =>'企业状态',
							'position' => '职务',
						],
					];
					break;
				case 'grxyyz':
					return $grxyyz = [
						'name' => '姓名',
						'idCard' => '身份证号',
						'status' => '结果状态',
						'statusDesc' => '结果状态',
					];
					break;
				case 'ylshposbg':
					return $ylshposbg = [
						'merchantNo' => 'POS单上商户编号',
						'arealDistribution' => '客户地域分布',
						'coreInformation' => '核心经营指标',
						'exceptionsTrade' => '异常经营指标',
						'loyaltie' => '客户忠诚度分析',
						'monthBusinessConditions' => '每月经营状况',
						'stabilityMessage' => '经营稳定性指标',
						'weekBusinessConditions' => '每周经营状况',
						'status' => '结果状态',
						'coreInformation' => [
							'customerPrice' => '客单价',
							'firstTradeDate' => '首次交易日期',
							'monthAvgDays' => '月均交易天数',
							'monthAvgTimes' => '近12月卡均交易次数',
							'monthHolidayMaxAmount' => '近12月法定节假日交易金额占比',
							'monthHolidayMaxTimes' => '近12月法定节假日交易笔数占比',
							'monthMaxAmount' => '近12月单月最大交易金额',
							'monthMinAmount' => '近12月单月最小交易金额',
							'posNum' => '有效交易POS终端台数',
							'scoresPrice' => '笔单价',
							'totalCardTrade' => '交易总卡数',
							'totalTrade' => '交易总笔数',
							'totalTransactionsAmount' => '交易总金额',
						],
						'arealDistribution' => [
							'amountPre' => '金额分布',
							'countPre' => '笔数分布',
							'personPre' => '交易人数占比',
						],
						'exceptionsTrade' => [
							'cardLargeTradeAmount' => '同卡大额交易金额汇总',
							'cardLargeTradeScores' => '同卡大额交易笔数汇总',
							'creditCardTotalScoresPre' => '贷记卡的交易总笔数占比',
							'creditCardTotalTradePre' => '贷记卡的交易总金额占比',
							'normalTimeTradePre' => '非正常时间的交易总金额占比',
							'normalTimeTradeScoresPre' => '非正常时间的交易总笔数占比',
							'normalTradeAmount' => '非正常交易卡交易金额汇总',
							'normalTradeCount' => '非正常交易卡交易笔数汇总',
							'reverseTradePrice' => '反向交易金额',
							'reverseTradeScores' => '反向交易笔数',
							'top5PriceTradePre' => '近十二个月交易金额前五客户的金额占比',
							'top5ScoresTradePre' => '近十二个月交易金额前五客户的笔数占比',
							'totalTradeFailed' => '交易失败金额',
							'tradeFailedScores' => '交易失败笔数',
						],
						'loyaltie' => [
							'amountPre' => '金额占比',
							'countPre' => '笔数占比',
							'personPre' => '交易人数占比',
						],
						'monthBusinessConditions' => [
							'cardSum' => '每月交易卡数',
							'cardSumRank' => '每月交易卡数在本市同行业的排名',
							'month' => '月份',
							'monthAmountGroRate' => '每月交易金额同比增长率',
							'monthAmt' => '每月交易金额',
							'monthAmtRank' => '每月交易金额在本市同行业中的排名',
							'monthCnt' => '每月交易笔数',
							'monthCntRank' => '每月交易笔数在本市同行业中的排名',
							'monthCountGroRate' => '每月交易笔数同比增长率',
						],
						'stabilityMessage' => [
							'belowWeekPriceAvgTimes' => '近24周低于周均交易额的周数',
							'transAmountCv' => '三个月移动平均交易金额变异系数',
							'transCardNumCv' => '三个月移动平均交易卡数变异系数',
							'transCountCv' => '三个月移动平均交易笔数变异系数',
						],
						'weekBusinessConditions' => [
							'weekTrans' => '每周交易金额和笔数List',
							'weekTransAvgAmt' => '周均交易金额',
							'weekTurnoverValue' => '周交易额中值',
						],
					];
					break;
			default:
				# code...
				break;
		}
	}


}