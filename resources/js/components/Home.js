import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import {Button, Card, Col, Container, Form, Row} from 'react-bootstrap';

function Home() {
  const [tweetText, setTweetText] = useState('');

  const handleTweet = () => {
    alert(tweetText);
  }

  return(
    <Container>
      <Row className="justify-content-center">
        <Col md={4}>
          <Card>
            <Card.Body>
              <Form.Control
                as="textarea"
                row={10}
                onChange={(e) => setTweetText(e.target.value)}
              ></Form.Control>
              <Button
                variant="primary"
                style={{ margin: "7px 0", width: "100%"}}
                onClick={(e) => handleTweet(e)}
              >ツイート</Button>
            </Card.Body>
          </Card>
        </Col>
        <Col md={8}>
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
