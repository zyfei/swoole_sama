<?php
namespace sama\tag;

use sama\Bean;
use sama\AC;
use sama\view\View;

/**
 * 类标签
 * @author zhangyufei
 *
 */
class ClassTag {

	/**
	 * 自动装配 Bean
	 */
	public static function bean($cla, $name = null) {
		if ($name == null) {
			$name = $cla;
		}
		Bean::bind($name, $cla);
	}

	/**
	 * 控制器
	 */
	public static function controller($cla, $parm = "") {
		Bean::bind($cla, $cla);
		if ($parm == "") {
			$parm = "/";
			$parm_arr = explode("\\", $cla);
			foreach ($parm_arr as $k => $n) {
				if ($n == "") {
					unset($parm_arr[$k]);
					continue;
				}
				for ($i = 0; $i < strlen($n); $i ++) {
					$char = ord($n[$i]);
					if ($char > 64 && $char < 91 && $i != 0) {
						$parm = $parm . "_";
					}
					$parm = $parm . strtolower($n[$i]);
				}
				$parm = $parm . "/";
			}
			$parm = substr($parm, 0, strlen($parm) - 1);
		}
		AC::$controller_url_map[$parm] = $cla;
	}

	/**
	 * 类注释解析
	 */
	public static function view($cla, $parm = "") {
		AC::$view_cla_tmpdir_map[$cla] = $parm;
	}
	
}