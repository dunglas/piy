<?php

class generateIgnoresTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('scm', sfCommandArgument::REQUIRED, 'Your SCM(git,svn or cvs)'),
    ));

    $this->addOptions(array(
      new sfCommandOption('add-ignores', null, sfCommandOption::PARAMETER_NONE, 'Adds ignores to the repository'),

    ));

    $this->aliases          = array('gen-ignores');
    $this->namespace        = 'util';
    $this->name             = 'generate-ignores';
    $this->briefDescription = 'Create ignores for your project';
    $this->detailedDescription = <<<EOF
This task will create the ignore files for your SCM.  It currently can do GIT and CVS ignore files.  It will ignore all base directories, the cache directory contents, the log directory contents, and configuration files that are specific to your computer(databases.yml,projectConfiguration.class.php).  It can add these ignore files to the repository if you toggle that option.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    switch(strtolower($arguments['scm']))
    {
      case 'git':
        $ignoreFileName='.gitignore';
        $forceAddIgnoreFileCommand="git add -f ";
        break;


      case 'cvs':
        $ignoreFileName='.cvsignore';
        $forceAddIgnoreFileCommand="cvs add  ";
        break;

      default:
        echo "Not a support SCM.  Only GIT and CVS are currently supported.";
        exit(1);
    }

    // config folder ignores
    $currentIgnore='config/'.$ignoreFileName;
    $ignoreFiles="ProjectConfiguration.class.php\ndatabases.yml\n";
    $this->writeIgnore($currentIgnore,$ignoreFiles,$options['add-ignores'], $forceAddIgnoreFileCommand);
    

    // Cache folder
    $currentIgnore='cache/'.$ignoreFileName;
    $ignoreFiles="*\n";
    $this->writeIgnore($currentIgnore,$ignoreFiles,$options['add-ignores'], $forceAddIgnoreFileCommand);


    // Log folder
    $currentIgnore='log/'.$ignoreFileName;
    $ignoreFiles="*\n";
    $this->writeIgnore($currentIgnore,$ignoreFiles,$options['add-ignores'], $forceAddIgnoreFileCommand);


    // Begin the looping through 
    $it=new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./'));
    $ignorePathArray=array();
    while($it->valid())
    {
      // Does it match a model/om, model/map, form/base, filter/base 
      if(strpos($it->getPath(),'model/om')||strpos($it->getPath(),'model/map')
        ||strpos($it->getPath(),'form/base')||strpos($it->getPath(),'filter/base'))
      {
        // Since we currently go through every file we only want to get the path once so use it as the key. 
        $ignorePathArray[$it->getPath()]=true; 

      }
      $it->next();

    }

    // Write the actual ignores to all the found paths
    foreach($ignorePathArray as $path => $value)
    {
      $currentIgnore=$path.'/'.$ignoreFileName;
      $ignoreFiles="*\n";
      $this->writeIgnore($currentIgnore,$ignoreFiles,$options['add-ignores'], $forceAddIgnoreFileCommand);

    }

    if($options['add-ignores'])
      echo "All set, ignores created and added!\n";
    else
      echo "All set, ignores created!\n";

  }

  private function writeIgnore($currentIgnore,$ignoreFiles,$addIgnore, $forceAddIgnoreFileCommand)
  {

    // Only write the ignore file if it doesn't alraedy exist incase someone made a special mod to it
    if(!file_exists($currentIgnore))
    {
      $file=fopen($currentIgnore,'w+');
      fwrite($file,$ignoreFiles);
      fclose($file);
      
    }
    if($addIgnore)
        system($forceAddIgnoreFileCommand.' '.$currentIgnore);
  }

 

}
