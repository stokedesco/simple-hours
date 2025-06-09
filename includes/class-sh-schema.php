<?php
class SH_Schema {
    public function __construct(){
        add_action('wp_head', array($this,'output_schema'));
    }
    public function output_schema(){
        list($weekly, $holidays) = SH_Shortcodes::get_data();
        $schema = array();

        if (is_array($weekly)) {
            foreach ($weekly as $day => $v) {
                if (!empty($v['closed'])) {
                    continue;
                }
                $schema[] = array(
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => $day,
                    'opens'     => $v['open'],
                    'closes'    => $v['close'],
                );
            }
        }

        if (is_array($holidays)) {
            foreach ($holidays as $h) {
                if (isset($h['closed'])) {
                    continue;
                }
                $schema[] = array(
                    '@type'        => 'OpeningHoursSpecification',
                    'validFrom'    => $h['from'],
                    'validThrough' => $h['to'],
                    'opens'        => $h['open'],
                    'closes'       => $h['close'],
                );
            }
        }
        echo "<script type='application/ld+json'>".json_encode($schema)."</script>";
    }
}
new SH_Schema();
