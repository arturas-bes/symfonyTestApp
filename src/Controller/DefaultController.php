<?php

namespace App\Controller;

use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Video;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;



class DefaultController extends AbstractController
{
    public function __construct(GiftsService $gifts, $logger)
    {
        //use $logger service

        // As functions in constructor execute first, we ovveride service method below as service was already called
    //    $gifts->gifts = ['a', 'b', 'c', 'd'];


    }
//    /**
//     * @Route("/", name="default")
//     */
//    /**
//     * Set variable into route and use it
//     * @Route("/{name}", name="default")
//     */
    /**
     * @Route("/home", name="home")
     * @param GiftsService $gifts
     * @return Response
     */

    public function index(GiftsService $gifts, Request $request, SessionInterface $session)
    {

//        $users  = $this->getDoctrine()->getRepository(User::class)->findAll();

//        if (!$users)
//        {
//            throw $this->createNotFoundException('User does not exist');
//        }






//        CRUD

//            WRITE

//        $entityManager = $this->getDoctrine()->getManager();
//        $user = new User();
//        $user->setName('Robert');
//        $entityManager->persist($user);
////        $entityManager->flush();
////       var_dump('A new user saved with id of '.$user->getId());

//        READ
//        $repository = $this->getDoctrine()->getManager()->getRepository(User::class );
//        FIND ONE RECORD
//        $user = $repository->find(1);
//        $user = $repository->findOneBy(['name' => 'Robert']);
//        FIND MULTIPLE RECORDS
//         $user = $repository->findBy(['name' => 'name - 1'],
//             ['id' => 'DESC']);
//        $user = $repository->findAll();

//        UPDATE
//        $entityManager = $this->getDoctrine()->getManager();
//        $id = 2;
//        $user = $entityManager->getRepository(User::class)->find($id);
//        if (!$user)
//        {
//            throw $this->createNotFoundException('No user found for id: '.$id);
//        }
//        $user->setName('New user name!');
//        $entityManager->flush();

//        DELETE

//        $entityManager = $this->getDoctrine()->getManager();
//        $id = 2;
//        $user = $entityManager->getRepository(User::class)->find($id);
//        $entityManager->remove($user);
//        $entityManager->flush();

//        CRUD END



//        RAW QUERIES

//        $entityManager = $this->getDoctrine()->getManager();
//    $conn = $entityManager->getConnection();
//    $sql = '
//    SELECT * FROM user u
//    WHERE u.id > :id
//    ';
//    $stmt = $conn->prepare($sql);
//    $stmt->execute(['id' => 3]);
//
//    var_dump($stmt->fetchAll());

//    RAW QUERIES END





//      TESTING VIDEO AND USER RELATIOSHIP


//        $entityManager = $this->getDoctrine()->getManager();
//        $user = new User();
//        $user->setName('Robert');
//
//        for ($i=1; $i<=3; $i++) {
//            $video = new Video();
//            $video->setTitle('Video title - '.$i);
//            $user->addVideo($video);
//            $entityManager->persist($video);
//        }
//        $entityManager->persist($user);
//
//        $entityManager->flush();
//
//        var_dump('Video: '.$video->getId());

//FIND VIDEO
//        $video = $this->getDoctrine()->getRepository(Video::class)->find(1);
//        var_dump($video->getUser()->getName());

//
//
//       FIND USER
        $user = $this->getDoctrine()->getRepository(User::class)->find(16);

        foreach ($user->getVideos() as $video) {
            var_dump($video->getTitle());
        }



//      TESTING VIDEO AND USER RELATIOSHIP END





//        exit($request->get('page', 'default')); // get data from $_GET
        $request->isXmlHttpRequest(); // is it an Ajax request?
        $request->request->get('page'); // get $_POST data
        $request->files->get('foo'); // get uploaded file data


//        $session->set('name', 'session value');
//        $session->remove('name');
//
//        $session->clear();      // clears all session data
//        if ($session->has('name'))
//        {
//            exit($session->get('name'));
//        };

//        exit($request->cookies->get('PHPSESSID'));
//        $cookie = new Cookie(
//            'my_cookie',
//            'cookie_value',
//            time() + (2 * 365 * 24 * 60 * 60)
//        );
//
//        $res = new Response();
//        $res->headers->setCookie($cookie);
//        $res->send();
//
//        $res->headers->clearCookie('my_cookie'); // clears stored cookie on denmand

        //add to database
//        $entityManager = $this->getDoctrine()->getManager(); //responsible for saving operations to DB
//        $user = new User;
//        $user->setName('Bob');
//        $entityManager->persist($user);
//        $entityManager->flush();
        // This was moved to service section
//        $gifts = array('flowers', 'car', 'piano', 'money');
//
//        shuffle($gifts);

        // flash messages

        $this->addFlash(
            'notice',
            'Your changes has been saved!'
        );
        $this->addFlash(
                'warning',
                'Your message has errors be careful!'
            );

//       Render with parameters
//        return $this->render('default/index.html.twig', array(
//            'controller_name' => 'DefaultController',
//            'users' => $users,
//            'random_gift' => $gifts->gifts,
//        ));

        return $this->render('default/index.html.twig', array(
            'controller_name' => 'DefaultController'
        ));


//        Response with dynamic variable
//         return new Response("Hello there $name");
//        JSON
//        return $this->json(array(
//            'username'=> 'john.doe'
//        ));
//        Redirect to another page
//        return $this->redirect('https://toybox.lt');

//        return $this->redirectToRoute('default2');


    }

//    /**
//     * @Route("/default2/", name="default2")
//     */
//    public function index2()
//    {
//        return new Response("Another route");
//    }

// no route cuz this methos only gonna be used to render html


    public function mostPopularPosts($number = 3)
    {
        // database call
        $posts = ['post_1', 'post_2', 'post_3', 'post_4'];
        return $this->render('default/most_popular_posts.html.twig', [
            'posts' => $posts,
        ]);
    }
    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     *
     */
    /* if {page?} means its optional*/
    public function index2()
    {
        return new Response('bla bla');
    }
// advanced route with many paramters
    /**
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}/{category}",
     *     defaults={"category": "computers"},
     *     requirements={
     *      "_locale": "en|fr",
     *      "category": "computers|rtv",
     *      "year": "\d+"
     *  }
     * )
     */
    public function index3()
    {
        return new Response('Advanced Route');
    }
//Translations for root
    /**
     * @Route({
     *     "nl": "/beleka",
     *     "en": "/something"
     *  }, name="about_us"
     * )
     */
    public function index4()
    {
        return new Response('Translated route');
    }

    /**
     * @Route("/generate-url/{param?}", name= "generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL)

        );
    }

    /**
     * @Route("/download")
     */
    public function download()
    {
        $path = $this->getParameter('download_directory');

        return $this->file($path.'photo.jpg');
    }

    /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }

    /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test Redirection');
    }

    /**
     * @Route("forwarding-to-controller")
     */
    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController:methodToForwardTo',
            array('param' => 1)
        );
        return $response;
    }

    /**
     * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     */
    public function methodToForwardTo($param)
    {
        exit('Test controller forwarding - '.$param);
    }




// GET USER WITHOU ENTITY MANAGER

    // advanced route with many paramters
    /**
     * @Route("/without-manager/{id}")
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function indexUser(Request $request, User $user)
    {
        var_dump($user);
        return new Response('Get Params without manager');
    }
}
