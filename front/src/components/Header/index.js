import React from 'react';
import './header.scss';

import ButtonLog from '.ButtonLog';

const Header = () => (
  <header className="header-container">
    <h1 className="title">Immo Site</h1>
    <ButtonLog />
  </header>
);

// == Export
export default Header;
