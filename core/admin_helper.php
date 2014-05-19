<?php

require_once DIR . '/core/html_helper.php';

class AdminHelper extends HtmlHelper
{
	public function admin_table($titles, $data) {

		$this->start_table(null, "table");

		// thead section
		echo "<thead>";
		$this->start_tr();

		foreach ($titles as $title) {
			$this->start_th();
			echo $title;
			$this->end_th();
		}

		$this->end_tr();
		echo "</thead>";

		// tbody section
		echo "<tbody>";

		if($data != null) {

			foreach ($data as $row) {
				$this->start_tr();

				foreach ($row as $item) {
					$this->start_td();
					echo $item;
					$this->end_td();
				}

				$this->end_tr();
			}
		}

		echo "</tbody>";

		$this->end_table();

	}
}

?>