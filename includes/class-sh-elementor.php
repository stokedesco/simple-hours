<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class SH_Elementor_Widget extends Widget_Base {
    public function get_name(){ return 'simple_hours'; }
    public function get_title(){ return 'Simple Hours'; }
    public function get_icon(){ return 'fa fa-clock'; }
    public function get_categories(){ return ['general']; }

    protected function _register_controls(){
        $this->start_controls_section('content_section', ['label'=>'Content','tab'=>Controls_Manager::TAB_CONTENT]);
        $this->add_control('mode', ['label'=>'Mode','type'=>Controls_Manager::SELECT,'options'=>['today'=>'Today','until'=>'Until','fullweek'=>'Full Week'],'default'=>'today']);
        $this->end_controls_section();
        $this->start_controls_section('style_section',['label'=>'Style','tab'=>Controls_Manager::TAB_STYLE]);
        $this->add_control('text_color',['label'=>'Text Color','type'=>Controls_Manager::COLOR]);
        $this->add_control('bg_color',['label'=>'Background Color','type'=>Controls_Manager::COLOR]);
        $this->add_control('border_color',['label'=>'Border Color','type'=>Controls_Manager::COLOR]);
        $this->add_group_control(Group_Control_Typography::get_type(), ['name'=>'typo','selector'=>'{{WRAPPER}}']);
        $this->add_control('padding',['label'=>'Padding','type'=>Controls_Manager::SLIDER,'size_units'=>['px']]);
        $this->add_control('margin',['label'=>'Margin','type'=>Controls_Manager::SLIDER,'size_units'=>['px']]);
        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        $style = sprintf('color:%s;background:%s;border-color:%s;padding:%spx;margin:%spx;',
            $settings['text_color'], $settings['bg_color'], $settings['border_color'],
            $settings['padding']['size'], $settings['margin']['size']
        );
        $short = '[simplehours_' . $settings['mode'] . ']';
        echo "<div style='{$style}'>" . do_shortcode($short) . "</div>";
    }

    public static function register_widget($widgets_manager){
        $widgets_manager->register_widget_type(new self());
    }
}
