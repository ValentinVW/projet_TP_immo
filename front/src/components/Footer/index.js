import React from 'react';
import './footer.scss';
import { Link } from 'react-router-dom';

const Footer = () => (
  <footer className="footer-container">
    <Link className="footer-contact" to="/Contact">Contact</Link>
    <Link className="footer-about" to="/about">A propos</Link>
  </footer>
);

// == Export
export default Footer;
