import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import {Button, Card, Col, Container, Form, Row} from 'react-bootstrap';
import axios from 'axios';

function Home() {
  const [tweetText, setTweetText] = useState('');

  const handleTweet = () => {
    const params = {
      tweet: tweetText
    };
    axios.post('/tweet', params)
      .then(res => {
        setTweetText('');
        //　ツイート一覧を読み直す処理
      })
      .catch(error => console.error(error));
  }

  return(
    <Container>
      <Row className="justify-content-center">
        <Col md={4}>
          <Card>
            <Card.Body>
              <Form.Control
                name="tweet"
                as="textarea"
                row={10}
                onChange={(e) => setTweetText(e.target.value)}
              />
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
