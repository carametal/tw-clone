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
      return;
    }
    if(tweetText.length > 140) {
      alert("ツイートが140文字以上です");
      return;
    }
    const params = {
      tweet: tweetText,
      userId: loginUser.id
    };
    axios.post('/tweets', params)
      .then(res => {
        initialTweetText();
        updateTimeline();
        updateUserDetail();
      })
      .catch(error => console.error(error));
  }

  const [tweets, setTweets] = useState([]);
  const updateTimeline = (type= 'all') => {
    axios.get('/timeline/' + _loginUser.id + '?type=' + type)
      .then(res => setTweets(res.data))
      .catch(error => console.error(error));
  }
  useEffect(updateTimeline, []);

  const [userDetail, setUserDetail] = useState({ count: 0, follows: 0, followers: 0});
  const updateUserDetail = () => {
    axios.get('tweets-detail/' + loginUser.id)
      .then(res => setUserDetail(res.data))
      .catch(error => console.error(error));
  };
  useEffect(updateUserDetail, []);

  const doFollow = (tweet, follow) => {
    const newTweets = tweets.map(t => {
      if(t.user_id === tweet.user_id) {
        t.follow_id = follow.id;
      }
      return t;
    });
    setTweets(newTweets);
    updateUserDetail();
  }

  const removeFollow = (tweet) => {
    const newTweets = tweets.map(t => {
      if(t.user_id === tweet.user_id) {
        t.follow_id = null;
      }
      return t;
    });
    setTweets(newTweets);
    updateUserDetail();
  };

  const doFavorite = (tweet, favorite) => {
    const copiedTweets = Object.assign([], tweets);
    const tweetIndex = copiedTweets.findIndex(t => {
      return t.id === tweet.id;
    });
    copiedTweets[tweetIndex].favorite_id = favorite.id;
    setTweets(copiedTweets);
    updateUserDetail();
  };

  const removeFavorite = (tweet) => {
    const copiedTweets = Object.assign([], tweets);
    const tweetIndex = copiedTweets.findIndex(t => {
      return t.id === tweet.id;
    });
    copiedTweets[tweetIndex].favorite_id = null;
    setTweets(copiedTweets);
    updateUserDetail();
  };

  const removeTweet = (tweet) => {
    const newTweets = tweets.filter(t => {
      return tweet !== t;
    });
    setTweets(newTweets);
    updateUserDetail();
  };

  const textColorOfTweetLength = tweetText.length > 140 ? 'red' : 'black';

  return(
    <Container>
      <Row className="justify-content-center">
        <Col md={4}>
          <Card>
            <Card.Body style={{ borderBottom: "1px solid rgba(0, 0, 0, 0.125)"}}>
              <h3><a href={"/users/" + _loginUser.id} style={{color:"black"}}>{loginUser.name}</a></h3>
              <div><a href={"/users/" + _loginUser.id} style={{color:"black"}}>ツイート数: { userDetail.count || 0}</a></div>
              <div><a href={"/follow-list/" + _loginUser.id} style={{color:"black"}}>フォロー: { userDetail.follows || 0}</a></div>
              <div><a href={"/follower-list/" + _loginUser.id} style={{color:"black"}}>フォロワー: { userDetail.followers || 0}</a></div>
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
              <div style={{textAlign: 'right', color: textColorOfTweetLength}}>
                <span>{tweetText.length}/140</span>
              </div>
              <Button
                variant="primary"
                style={{ margin: "7px 0", width: "100%"}}
                onClick={(e) => handleTweet(e)}
                disabled={!tweetText || tweetText.length > 140}
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
            doFavorite={doFavorite}
            removeFavorite={removeFavorite}
            removeTweet={removeTweet}
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
