<?php
namespace SS\Bundle\AppBundle\Service;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * UserMailer.
 */
class Messanger
{

    /**
     * @var string
     */
    private $emailNoReply;


    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;



    /**
     * @param string $emailNoReply
     */
    public function __construct(
        $emailNoReply, EngineInterface $engine, \Swift_Mailer $mailer
    )
    {
        $this->engine = $engine;
        $this->emailNoReply = $emailNoReply;
        $this->mailer = $mailer;
    }


    /**
     * @param $template
     * @param $data
     * @param $emailTo
     * @param $emailFrom
     * @return bool
     */
    public function sendEmail($template, $data, $emailTo, $emailFrom = null)
    {
        $message = \Swift_Message::newInstance();
        $message->setTo($emailTo);
        $message->setSubject('SS order');
        $message->setFrom( $emailFrom?$emailFrom:$this->emailNoReply)
                ->setBody($this->engine->render($template, ['data'=> $data])
        , 'text/html' );

        try {
            $response['success'] = $this->mailer->send($message) > 0;
        } catch (\Exception $e) {
            $response['success'] = false;
        }

        return $response['success'];
    }
}