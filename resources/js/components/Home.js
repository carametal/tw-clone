import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import {Button, Card, Col, Container, Form, Row} from 'react-bootstrap';
import axios from 'axios';
import TimeLine from "./TimeLine";

function Home(props) {
  const [tweetText, setTweetText] = useState('');

  const [loginUser, setLoginUser] = useState(_loginUser);

  const initialTweetText = () => {
    setTweetText('');
  }

  const handleTweet = () => {
    if(!tweetText) {
      alert("ツイートが空です");
    }
    const params = {
      tweet: tweetText
    };
    axios.post('/tweet', params)
      .then(res => {
        initialTweetText();
        updateTimeline();
      })
      .catch(error => console.error(error));
  }

  const [tweets, setTweets] = useState([]);
  const updateTimeline = (type= 'all') => {
    axios.get('timeline/' + _loginUser.id + '?type=' + type)
      .then(res => setTweets(res.data))
      .catch(error => console.error(error));
  }
  useEffect(updateTimeline, []);

  const [usersDetail, setUsersDetail] = useState({ count: 0, follows: 0, followers: 0});
  const updateTweetsCount = () => {
    axios.get('tweets-detail/' + loginUser.id)
      .then(res => setUsersDetail(res.data))
      .catch(error => console.error(error));
  };
  useEffect(updateTweetsCount, []);

  const doFollow = (tweet, follow) => {
    const newTweets = tweets.map(t => {
      if(t.user_id === tweet.user_id) {
        t.follow_id = follow.id;
      }
      return t;
    });
    setTweets(newTweets);
  }

  const removeFollow = (tweet) => {
    const newTweets = tweets.map(t => {
      if(t.user_id === tweet.user_id) {
        t.follow_id = null;
      }
      return t;
    });
    setTweets(newTweets);
  };

  return(
    <Container>
      <Row className="justify-content-center">
        <Col md={4}>
          <Card>
            <Card.Body style={{ borderBottom: "1px solid rgba(0, 0, 0, 0.125)"}}>
              <h3>{ loginUser.name }</h3>
              <div> ツイート数: { usersDetail.count}</div>
              <div>フォロー: { usersDetail.follows}</div>
              <div>フォロワー: { usersDetail.followers}</div>
            </Card.Body>
            <Card.Body>
              <Form.Control
                name="tweet"
                as="textarea"
                value={tweetText}
                rows={10}
                style={{ resize: 'none'}}
                onChange={(e) => setTweetText(e.target.value)}
              />
              <Button
                variant="primary"
                style={{ margin: "7px 0", width: "100%"}}
                onClick={(e) => handleTweet(e)}
                disabled={!tweetText}
              >ツイート</Button>
            </Card.Body>
          </Card>
        </Col>
        <Col md={8}>
          <TimeLine
            tweets={tweets}
            updateTiimeLine={updateTimeline}
            doFollow={doFollow}
            removeFollow={removeFollow}
          />
        </Col>
      </Row>
    </Container>
  );
}

export default Home;

if (document.getElementById('home')) {
    ReactDOM.render(<Home />, document.getElementById('home'));
}
