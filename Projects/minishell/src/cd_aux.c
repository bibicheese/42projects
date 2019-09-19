/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   cd_aux.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/19 15:02:40 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/19 20:49:29 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

char			**newpwd(char *oldpwd, char *pwd)
{
	char	**env;
	
	if (!(env = (char **)malloc(sizeof(char *) * 3)))
		return (NULL);
	env[0] = ft_strjoin("PWD=", pwd);
	env[1] = ft_strjoin("OLDPWD=", oldpwd);
	env[2] = NULL;
	return (env);
}

static char		**replaceoldpwd(t_shell *shell, char *oldpwd, char **env)
{
	char	**newenv;
	int		i;
	int		add;

	if (!(newenv = (char **)malloc(sizeof(char *)
		 * (ft_arrlen(env) + 2))))
        return (NULL);
	i = -1;
	add = 1;
	while (env[++i])
	{
		if (!ft_strcmp(shell->lenv[i], "OLDPWD"))
		{
			add = 0;
			newenv[i] = ft_strjoin("OLDPWD=", oldpwd);
		}
		else
			newenv[i] = ft_strdup(env[i]);
	}
	if (add)
	{
		printf("hellooooooooo\n");
		newenv[i++] = ft_strjoin("OLDPWD=", oldpwd);
	}
	newenv[i] = NULL;
	ft_memdel((void **)env);
	return (newenv);
}

char			**replacepwd(t_shell *shell, char *oldpwd, char *pwd)
{
	char	**newenv;
	int		i;
	int		add;

	if (!(newenv = (char **)malloc(sizeof(char *)
		 * (ft_arrlen(shell->env) + 2))))
        return (NULL);
    i = -1;
	add = 1;
    while (shell->env[++i])
    {
		if (!ft_strcmp(shell->lenv[i], "PWD"))
		{
			add = 0;
			newenv[i] = ft_strjoin("PWD=", pwd);
		}
		else
			newenv[i] = ft_strdup(shell->env[i]);
	}
	if (add)
		newenv[i++] = ft_strjoin("PWD=", pwd);
	newenv[i] = NULL;
	newenv = replaceoldpwd(shell, oldpwd, newenv);
	return (newenv);
}
