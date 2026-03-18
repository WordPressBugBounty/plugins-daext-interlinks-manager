const {registerPlugin} = wp.plugins;
import render from './components/Sidebar';

registerPlugin(
    'daextinma-interlinks-optimization',
    {
      icon: false,
      render,
    },
);