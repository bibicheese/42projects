/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   command.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/12 14:45:02 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/12 18:11:33 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

char	*find_cmd(t_shell *shell, char *cmd)
{
	int				i;
	int				br;
	char			*path;
	char			*tmp;

	i = 0;
	br = 0;
	if (!(shell->paths))
		return (NULL);
	while (shell->paths[i])
	{
		tmp = ft_strjoin(shell->paths[i], cmd);
		if (!access(tmp, F_OK) && !access(tmp, X_OK))
			break;
		i++;
	}
	path = ft_strjoin(shell->paths[i], cmd);
	return (path);
	
}
