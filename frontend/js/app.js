import React from 'react';
import ReactDOM from 'react-dom';
import { HydraAdmin } from '@api-platform/admin';

// To use Hydra:
const Admin = () => <HydraAdmin entrypoint="http://localhost/api" />;
ReactDOM.render(<Admin />, document.getElementById('app'));