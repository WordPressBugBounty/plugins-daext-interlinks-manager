const {registerPlugin} = wp.plugins;
import render from './components/Sidebar';

registerPlugin(
    'daextinma-interlinks-options',
    {
      icon: false,
      render,
    },
);