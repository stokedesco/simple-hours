import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';
import { SelectControl } from '@wordpress/components';

registerBlockType('simple-hours/block', {
  title: 'Simple Hours',
  category: 'widgets',
  icon: 'clock',
  attributes: {
    mode: { type: 'string', default: 'today' }
  },
  edit({ attributes, setAttributes }) {
    return (
      <div>
        <SelectControl
          label="Mode"
          value={attributes.mode}
          options={[
            { label: 'Today', value: 'today' },
            { label: 'Until', value: 'until' },
            { label: 'Full Week', value: 'fullweek' }
          ]}
          onChange={(mode) => setAttributes({ mode })}
        />
        <ServerSideRender
          block="simple-hours/block"
          attributes={attributes}
        />
      </div>
    );
  },
  save() {
    return null;
  }
});