import React from 'react';
import ReactDOM from 'react-dom';
import { Card, Col, Container, Row } from 'react-bootstrap';

function Home() {
  return(
    <Container>
      <Row className="justify-content-center">
        <Col className="col-md-8">
          <Card>
            <Card.Header>Home Header.</Card.Header>
            <Card.Body>Home Body.</Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
}

export default Home;

if (document.getElementById('home')) {
    ReactDOM.render(<Home />, document.getElementById('home'));
}